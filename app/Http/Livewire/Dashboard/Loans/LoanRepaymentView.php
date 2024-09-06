<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Classes\Exports\RepaymentExport;
use App\Models\Loans;
use App\Traits\LoanTrait;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LoanRepaymentView extends Component
{
    use LoanTrait;
    public $loan_requests;
    public function render()
    {
        $this->loan_requests = $this->getDueLoanRequests('auto');
        return view('livewire.dashboard.loans.loan-repayment-view')
        ->layout('layouts.main');
    }

    public function exportRepaymentLoans(){
        return Excel::download(new RepaymentExport(), 'Pending Repayment Loans.xlsx');
    }
}
