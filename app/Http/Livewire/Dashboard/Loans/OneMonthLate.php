<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;
use App\Traits\LoanTrait;

class OneMonthLate extends Component
{
    use LoanTrait;
    public $loan_requests;


    public function render(){
        $this->loan_requests = $this->getOneMonthLate('auto');
        return view('livewire.dashboard.loans.one-month-late')->layout('layouts.main');
    }
}
