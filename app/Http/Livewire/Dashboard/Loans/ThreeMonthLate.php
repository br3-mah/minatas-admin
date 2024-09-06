<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;
use App\Traits\LoanTrait;

class ThreeMonthLate extends Component
{
    use LoanTrait;
    public $loan_requests;


    public function render(){
        $this->loan_requests = $this->getThreeMonthLate('auto');
        return view('livewire.dashboard.loans.three-month-late')->layout('layouts.main');
    }
}
