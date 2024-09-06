<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;
use App\Traits\LoanTrait;

class NoRepayments extends Component
{
    use LoanTrait;
    public $loan_requests;


    public function render(){
        $this->loan_requests = $this->getNoRepaymentLoan('auto');
        return view('livewire.dashboard.loans.no-repayments')->layout('layouts.main');
    }
}
