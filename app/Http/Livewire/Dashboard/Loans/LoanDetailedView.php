<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Traits\EmailTrait;
use App\Traits\LoanTrait;
use App\Traits\WalletTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Status;
use App\Models\ApplicationStage;
use App\Models\LoanExpense;
use App\Traits\CalculatorTrait;
use Livewire\Component;
use Illuminate\Support\Carbon;

class LoanDetailedView extends Component
{
    use CalculatorTrait, EmailTrait, WalletTrait, LoanTrait, AuthorizesRequests;
    public $loan, $user, $loan_id, $msg, $due_date, $reason, $loan_product;
    public $loan_stage, $denied_status, $picked_status, $current;
    public $amortizationSchedule, $amortization_table;
    public $loan_interest_value, $principal, $lp;
    public $exp_date, $exp_name, $exp_amount, $exp_type, $exp_details, $current_expenses;

    public function mount($id){
        $this->loan_id = $id;
    }
    public function render()
    {
        $this->authorize('processes loans');
        $this->loan = $this->get_loan_details($this->loan_id);
        $this->loan_product = $this->get_loan_product($this->loan->loan_product_id);
        $this->loan_stage = $this->get_loan_current_stage($this->loan->loan_product_id);
        $this->denied_status = Status::where('stage', 'denied')
        ->orderBy('id')
        ->get();
        $this->current_expenses = $this->get_loan_expenses($this->loan_id);
        $this->current = ApplicationStage::where('application_id', $this->loan->id)->first();
        $this->getAmoritizationTable();
        return view('livewire.dashboard.loans.loan-detailed-view')
        ->layout('layouts.main');
    }

    public function prefillLoanProductValues(){
        try {
            $this->lp = $this->get_loan_product($this->loan->loan_product_id);
            $this->loan_interest_value = $this->lp->def_loan_interest / 100;
            $this->principal = $this->loan->amount;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getAmoritizationTable(){
        try {

        $this->prefillLoanProductValues();
            $data = [
                'loan_duration_period' => 'month',
                'loan_duration_value' => $this->loan->repayment_plan,
                'principal' => $this->principal,
                'loan_interest_value' => $this->loan_interest_value,
                'num_of_repayments' => $this->loan->repayment_plan,
                'release_date' => Carbon::now()->format('d-m-Y'),  // Formatting date as Day-Month-Year
            ];
            $this->amortization_table = $this->calculateEqualInstallment($data);
        } catch (\Throwable $th) {
            $this->amortization_table = [];
        }
    }

    public function createExpense(){
        try {
            LoanExpense::create([
                'name' => $this->exp_name,
                'description' => $this->exp_details,
                'amount' => $this->exp_amount,
                'date' => $this->exp_date,
                'type' => $this->exp_type,
                'application_id' => $this->loan->id
            ]);
            session()->flash('success', 'Loan expense created successfully!');
            return redirect()->route('detailed', $this->loan->id);
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
}
