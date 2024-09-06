<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Models\Application;
use App\Models\ApplicationStage;
use App\Models\InterestMethod;
use App\Models\LoanManualApprover;
use App\Models\LoanStatus;
use App\Models\Status;
use App\Traits\CalculatorTrait;
use App\Traits\CRBTrait;
use App\Traits\EmailTrait;
use App\Traits\LoanTrait;
use App\Traits\WalletTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class LoanDetailView extends Component
{
    use CalculatorTrait, EmailTrait, WalletTrait, LoanTrait, CRBTrait, AuthorizesRequests;
    public $loan, $user, $loan_id, $msg, $due_date, $reason, $loan_product;
    public $loan_stage, $denied_status, $picked_status, $current, $principal_amt, $code, $crb, $crb_results;
    public $amortizationSchedule,$amo_principal, $amo_duration;
    public $employee_name, $employee_number;
    public $deductions = [];
    public $debt_ratio, $gross_pay, $basic_pay, $net_pay, $result_amount;
    public $crb_selected_products, $loan_notifications, $plp_rule, $plp;
    public $lp, $loan_interest_value, $principal, $amortization_table;
    public $loan_interest_method, $interest_methods, $loan_ai;

    public function mount($id){
        $this->loan_id = $id;
    }

    public function render()
    {
        // $this->authorize('processes loans');
        $this->change_status();
        $this->init_data();
        return view('livewire.dashboard.loans.loan-detail-view')
        ->layout('layouts.main');
    }

    public function init_data(){
        //Data fetch
        $this->loan = $this->get_loan_details($this->loan_id);
        $this->loan_notifications = $this->loan_notifications($this->loan->id);
        $this->loan_product = $this->get_loan_product($this->loan->loan_product_id);
        // dd($this->loan_product);
        $this->crb_selected_products = $this->loan_product->loan_crb;
        $this->loan_stage = $this->get_loan_current_stage($this->loan->loan_product_id);
        $this->denied_status = Status::where('stage', 'denied')->orderBy('id')->get();
        $this->current = ApplicationStage::where('application_id', $this->loan->id)->first();
        $this->interest_methods = InterestMethod::get();
    }

    public function prefillLoanProductValues(){
        try {
            $this->lp = $this->get_loan_product($this->loan->loan_product_id);
            $this->loan_interest_value =$this->lp->def_loan_interest / 100;
            $this->principal = $this->loan->amount;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getAmoritizationTable(){
        try {
            $data = [
                'loan_duration_period' => 'month',
                'loan_duration_value' => $this->loan->repayment_plan,
                'principal' => $this->principal,
                'loan_interest_value' => $this->loan_interest_value,
                'num_of_repayments' => $this->loan->repayment_plan,
                'release_date' => Carbon::now()->format('d-m-Y'),  // Formatting date as Day-Month-Year
            ];
            // dd($data);
            $this->amortization_table = $this->calculateEqualInstallment($data);

            // dd($this->amortization_table);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function CheckCRB()
    {
        if($this->code){
            if($this->code === 's'){
                // $response = $this->soapApiCRBDemoRequest($this->code, $this->loan->user);
                // $response = $this->soapApiCRBDemoRequest($this->code, $this->loan->user);
            }else{
                $response = $this->soapApiCRBRequest($this->code, $this->loan->user);
            }
            $parser = xml_parser_create();
            xml_parse_into_struct($parser, $response, $values, $index);
            xml_parser_free($parser);

            $this->crb_results = [
                'values' => $values,
                'index' => $index,
                'html' => $response
            ];
        }
    }

    public function acceptSuggestionBtn(){
        try {
            $switch = $this->loan;
            $switch->old_amount = $switch->amount;
            $switch->amount = $this->plp;
            $switch->save();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function setLoanID($id){
        $this->loan_id = $id;
    }

    public function confirm($id, $msg){
        $this->loan_id = $id;
        $this->msg = $msg;
    }

    public function clear(){
        $this->loan_id = '';
        $this->msg = '';
    }

    // This method activates the reviewing state
    public function reviewLoan()
    {
        Application::where('id', $this->loan_id)->update(['status' => 2]);
        LoanManualApprover::where('user_id', auth()->id())->update(['is_processing' => 1]);
        // Redirect to other page here
        Redirect::route('loan-details',['id' => $this->loan_id]);
        session()->flash('success', 'Loan successfully set under review!');
        sleep(3);
    }

    public function rollbackLoan(){
        try {
            switch (strtolower($this->current->status)) {
                case 'approval':
                    // Update the approval to the previous stage Verificiation
                    $this->current->update([
                        'state' => 'current',
                        'status' => 'verification',
                        'stage' => 'processing',
                        'prev_status' => 'complete',
                        'curr_status' => 'bg-white',
                        'position' => $this->current->position - 1, // Decrease position to go backwards
                    ]);
                    break;
                case 'disbursements':
                    // Update the approval to the previous stage Approval
                    $this->current->update([
                        'state' => 'current',
                        'status' => 'approval',
                        'stage' => 'processing',
                        'prev_status' => 'complete',
                        'curr_status' => 'bg-white',
                        'position' => $this->current->position - 1, // Decrease position to go backwards
                    ]);
                    break;

                default:
                    break;
            }
            // Flash success message
            session()->flash('success', 'Loan successfully rolled back!');
            // Redirect back with success message
            return redirect()->route('loan-details',$this->loan_id);

        } catch (\Throwable $th) {
            dd($th);
        }
    }


    // This method is the actual approval process - Recommended
    public function accept($id){
        // DB::beginTransaction();

        try {
            $application_request = Application::find($id);
            $this->change_stage();
            if($this->final_approver($id)['status']){
                // Make the loan when disbursed
                // $this->make_loan($x, $this->due_date);
                // $this->isCompanyEnough($x->amount);
                // dd($application_request);
                // Do this - If this officer is the last approver
                // dd(strtolower($this->loan_stage->stage));
                if(strtolower($this->loan_stage->stage) == 'disbursements'){
                    $this->current->update([
                        'state' => 'current',
                        'status' => 'Current Loan',
                        'stage' => 'open',
                        'prev_status' => 'complete',
                        'curr_status' => 'bg-white',
                        'position' => 4,
                    ]);
                    $this->approve_final($application_request);
                }else{
                    $this->approve_continue($id);
                }
            }else{
                $this->approve_continue($id);
            }
            Redirect::route('loan-details',['id' => $this->loan_id]);
        } catch (\Throwable $th) {
            // DB::rollback();
            session()->flash('error', 'Oops something failed here, please contact the Administrator.'.$th);
        }
    }

    // Only when step is accepted
    public function change_stage(){
        try {
            $next_status = LoanStatus::with('status')
            ->where('loan_product_id', $this->loan_product->id)
            ->orderBy('id', 'asc')
            ->skip($this->current->position) // $this->current is 0-indexed, no need to subtract 1
            ->take(1)
            ->first();

            $this->current->update([
                'state' => 'current',
                'status' => $next_status->status->name,
                'stage' => $next_status->stage,
                'prev_status' => 'complete',
                'curr_status' => 'bg-white',
                'position' => $this->current->position + 1,
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function change_status(){
        try {

            $application = Application::find($this->loan_id);
            // dd($this->current->stage);
            if ($this->current->stage == 'open') {
                $application->status = 1;
            } elseif($this->current->stage == 'denied') {
                $application->status = 3;

            } elseif($this->current->stage == 'defaulted') {
                $application->status = 4;
            }elseif($this->current->stage == 'Not Taken Up') {
                $application->status = 5;
            }else{}
            $application->save();
        } catch (\Throwable $th) {
            dd('Cant Change Status: '.$th->getMessage());
        }
    }

    public function approve_continue($id){
        $this->upvote($id);
    }

    public function approve_final($x){
        $this->upvote($x->id);
        $currentDate = Carbon::now();
        $futureDate = $currentDate->addMonths((int)$x->repayment_plan);
        $x->status = 1;
        $x->due_date = $futureDate;
        $x->save();

        if($x->email != null){
            $mail = [
                'user_id' => $x->user_id,
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan, $x->loan_product_id),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been successfully accepted'
            ];
            $this->send_loan_accepted_notification($mail);
        }
        $this->deposit($x->amount, $x);
        DB::commit();
        session()->flash('success', 'Successfully transfered '.$x->amount.' to '.$x->fname.' '.$x->lname);
    }


    public function stall($id){
        try {
            $x = Application::find($id);
            $x->status = 2;
            $x->save();

            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application is under review'
            ];
            $this->send_loan_feedback_email($mail);
            $this->render();
            session()->flash('info', 'Application is under review.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }


    public function reverse($id){
        try {
            $x = Application::find($id);
            $x->status = 2;
            $x->save();

            // Make a Denied Stage status page as active
            LoanStatus::where('loan_product_id', $this->loan_product->id)
            ->orderBy('id')
            ->update(['state' => 'pending']);
            LoanStatus::where('loan_product_id', $this->loan_product->id)
            ->where('status_id', $this->picked_status)
            ->orderBy('id')
            ->first()
            ->update(['state' => 'current']);

            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' has been taken up and is currently under review, please wait withing the next 48 hours.'
            ];
            $this->withdraw($x->amount, $x);
            $this->send_loan_feedback_email($mail);
            session()->flash('success', 'Loan has been reverted successfully');
        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }

    public function rejectOnly(){

        try {
            $x = Application::find($this->loan_id);
            $x->status = 3;
            $x->save();

            $this->current->update([
                'state' => 'current',
                'status' => $this->picked_status,
                'stage' => 'denied',
                'prev_status' => 'complete',
                'curr_status' => 'bg-white',
            ]);

            $mail = [
                'user_id' => $x->user_id,
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'estimate' => 500,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request. After careful consideration, we regret to inform you that your loan request has been declined. REASON: '.$this->reason
            ];

            $this->send_loan_declined_notification($mail);
            Redirect::route('loan-details',['id' => $this->loan_id]);
            session()->flash('success', 'Loan has been rejected');

        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }

    public function reprocess(){

    }

}
