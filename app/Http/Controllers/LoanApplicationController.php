<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStage;
use App\Models\User;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use App\Traits\EmailTrait;
use App\Traits\FileTrait;
use App\Traits\LoanTrait;
use App\Traits\SMSTrait;
use App\Traits\SettingTrait;
use App\Traits\UserTrait;
use App\Traits\WalletTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoanApplicationController extends Controller
{
    use EmailTrait, LoanTrait, UserTrait, WalletTrait, FileTrait, SettingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoan(Request $req)
    {
        $email = $req->toArray()['email'];
        $application = User::where('email', $email)->get()->toArray();
        // $application = Application::where('email', $email)
        //                             ->where('status', 0)
        //                             ->where('can_change', 0)->get()->first();
        if(!empty($application)){
            $data = 1;
            return response()->json($data, 200);
        }else{
            $data = 0;
            return response()->json($data, 200);
        }
    }

    public function updateExistingLoan(Request $req)
    {
        $email = $req->toArray()['email'];
        try{
            Application::where('email', $email)->update(['can_change' => 1]);
            $data = 1;
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = 0;
            return response()->json($data, 500);
        }
    }

    

    public function updateFiles(Request $request)
    {
        // DB::beginTransaction();
        try {
            $user = Application::where('user_id',auth()->user()->id)->where('status', 0)->where('complete', 0)->first();

            if($request->file('nrc_file') !== null){
                $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public');
                $user->nrc_file = $nrc_file;
                $user->save();
            }

            if($request->file('tpin_file') !== null){
                $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');
                $user->tpin_file = $tpin_file;
                $user->save();
            }

            if($request->file('payslip_file') !== null){
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');
                $user->payslip_file = $payslip_file;
                $user->save();
            }

            $this->isKYCComplete();

            // DB::commit();
            return redirect()->to('/user/profile');
        } catch (\Throwable $th) {
            dd($th);
            // DB::rollback();
            return redirect()->to('/user/profile');
        }

    }

    public function updateKYCFiles(Request $request){
        try {
            // First Upload the files
            $this->uploadCommonFiles($request);

            // Personal Info
            $input = $request->toArray();
            $user = auth()->user();
            $user->fname = $input['fname'];
            $user->lname = $input['lname'];
            $user->phone = $input['phone'];
            // $user->email = $input['email'];
            $user->address = $input['address'];
            $user->occupation = $input['occupation'];
            $user->id_type = $input['id_type'];
            $user->nrc_no = $input['nrc_no'];
            $user->nrc = $input['nrc_no'];
            $user->dob = $input['dob'];
            $user->gender = $input['gender'];
            $user->save();

            $this->isKYCComplete();
            return redirect()->route('dashboard')->with('success', 'KYC Updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('success', 'KYC Update failed');
        }
    }
    

    public function new_proxy_loan(Request $request)
    {
        // DB::beginTransaction();
        try {
            $form = $request->toArray();
            $this->uploadCommonFiles($request);
            $user = User::find($form['borrower_id']);
            $data = array_merge($form, [
                'user_id' => $form['borrower_id'],
                'lname' => $user->lname,
                'fname' => $user->fname,
                'email' => $user->email ?? '',
                'phone' => $user->phone,
                'gender' => $user->gender,
                'processed_by' => auth()->id(),
            ]);
            $this->createRelatedParties($form);
            $this->createGuarantors($form);
            $applicationId = $this->apply_loan($data);
            $mail = [
                'application_id' => $applicationId,
                'name' => "{$user->fname} {$user->lname}",
                'loan_type' => $form['type'],
                'phone' => $user->phone,
                'duration' => $form['repayment_plan'],
                'amount' => $form['amount'],
                'type' => 'loan-application',
                'msg' => "You have a new {$form['type']} loan application request from {$user->fname} {$user->lname}, please visit the site to view more details",
            ];

            // $emailSent = $this->send_loan_email($mail);
            // DB::commit();
            Session::flash('success', "Loan created successfully");
            // if (!$emailSent) {
            //     Session::flash('error', "Could not send email to Customer, Please inform them about their new loan");
            // }

            return redirect()->route('view-loan-requests');
        } catch (\Throwable $th) {
            // DB::rollback();
            Session::flash('error', "Something failed. " . $th->getMessage());
            return redirect()->back();
        }
    }


    public function updateLoanDetails(Request $request)
    {
        DB::beginTransaction();
        try {
            $form = $request->toArray();
            // Update files
            $this->uploadCommonFiles($request);
            $user = User::where('id', $form['borrower_id'])->first();

            $data = [
                'user_id'=> $form['borrower_id'],
                'lname'=> $user->lname,
                'fname'=> $user->fname,
                'email'=> $user->email ?? '',
                'amount'=> $form['amount'],
                'phone'=> $user->phone,
                'gender'=> $user->gender,
                'loan_product_id'=> $form['loan_product_id'],
                'repayment_plan'=> $form['repayment_plan'],

                // 'glname'=> $form['glname'],
                // 'gfname'=> $form['gfname'],
                // 'gemail'=> $form['gemail'],
                // 'gphone'=> $form['gphone'],
                // 'g_gender'=> $form['g_gender'],
                // 'g_relation'=> $form['g_relation'],

                // 'g2lname'=> $form['g2lname'],
                // 'g2fname'=> $form['g2fname'],
                // 'g2email'=> $form['g2email'],
                // 'g2phone'=> $form['g2phone'],
                // 'g2_gender'=> $form['g2_gender'],
                // 'g2_relation'=> $form['g2_relation'],

                // 'doa' => $form['doa'] ?? $loan_req->doa,

                // 'tpin_file' => $form['tpin_file'] ?? $tpin_file,
                // 'payslip_file' => $form['payslip_file'] ?? $payslip_file,
                // 'nrc_file' => $form['nrc_file'] ?? $nrc_file,
                // 'complete' => $form['complete'],
                'processed_by'=> auth()->user()->id
            ];

            $this->apply_update_loan($data, $form['loan_id``']);
            // if($form['loan_status'] == 1){
            //     // Update borrower wallet
            //     $this->updateUserWallet($form['borrower_id'], $form['amount'], $form['old_amount']);

            //     // Delete Withdrawal requests
            //     WithdrawRequest::where('user_id', '=', $form['borrower_id'])->delete();

            //     // Update due date
            //     if($form['new_due_date'] !== null){
            //         $this->remake_loan($form['loan_id'], $form['new_due_date']);
            //     }
            // }

            // Email going to the Administrator
            // $process = $this->send_loan_email($mail);
            DB::commit();
            Session::flash('success', $user->fname . ' ' . $user->lname ."'s Loan updated successfully");
            // if (!$process) {
            //     Session::flash('error', "Could not send email to Customer, Please inform them about their new loan");
            // }

            return redirect()->route('view-loan-requests');
        } catch (\Throwable $th) {
            Session::flash('error',"Loan updated Failed");
            DB::rollback();
            return redirect()->back();
        }
    }
    


    public function assign_manual(Request $request){
        try {
            $set = $this->set_manual_loan_approvers($request->toArray());
            Session::flash('success', "Loan successfully assigned.");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function resetLoans(Request $request)
    {
        $loanIds = $request->toArray(); // Assuming $request->toArray() contains an array of loan IDs

        foreach ($loanIds as $id) {
            // Assuming 'Application' is the model representing your loans table
            $loan = Application::where('id',$id)->first();

            if ($loan) {
                $loan->status = 2;
                $loan->save();
            }

            // $stage = ApplicationStage::where('application_id', $loan->id)->first();
            // $stage->status = 'verification';
            // $stage->stage = 'processing';
            // $stage->state = 'current';
            // $stage->position = 1;
            // $stage->save();
        }
        return response()->json([
            "status" => 200,
            "success" => true
        ]);
    }
    public function deleteLoans(Request $request)
    {
        $loanIds = $request->toArray(); // Assuming $request->toArray() contains an array of loan IDs

        foreach ($loanIds as $id) {
            // Assuming 'Application' is the model representing your loans table
            $loan = Application::where('id',$id)->first();

            if ($loan) {
                $loan->delete();
            }
        }
        return response()->json([
            "status" => 200,
            "success" => true
        ]);
    }

}
