<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;
use App\Traits\LoanTrait;

class LoanArears extends Component
{
    use LoanTrait;
    public $loan_requests;


    public function render(){
        $this->loan_requests = $this->getLoanArears('auto');
        return view('livewire.dashboard.loans.loan-arears')->layout('layouts.main');
    }
}
