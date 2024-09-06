<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;
use App\Traits\LoanTrait;

class PrincipalOutstanding extends Component
{
    use LoanTrait;
    public $loan_requests;


    public function render(){
        $this->loan_requests = $this->getPrincipalOutstandingLoan('auto');
        return view('livewire.dashboard.loans.principal-outstanding')->layout('layouts.main');
    }
}
