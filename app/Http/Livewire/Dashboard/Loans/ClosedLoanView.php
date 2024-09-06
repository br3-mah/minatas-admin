<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Classes\Exports\ClosedLoanExport;
use App\Models\Application;
use App\Models\Loans;
use App\Traits\LoanTrait;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ClosedLoanView extends Component
{
    use LoanTrait;
    public $loan_requests;
    public function render()
    {
        $this->loan_requests = $this->getClosedLoanRequests('auto');
        return view('livewire.dashboard.loans.closed-loan-view')
        ->layout('layouts.main');
    }

    public function exportClosedLoans(){
        return Excel::download(new ClosedLoanExport(), 'Closed Loans.xlsx');
    }
}
