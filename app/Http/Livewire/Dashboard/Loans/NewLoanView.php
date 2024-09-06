<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Http\Livewire\Dashboard\Borrowers\BorrowerView;
use App\Models\LoanProduct;
use App\Models\User;
use App\Traits\LoanTrait;
use App\Traits\UserTrait;
use Livewire\Component;

class NewLoanView extends Component
{
    public $products, $borrowers;
    use UserTrait, LoanTrait;
    public function render()
    {
        $this->products = $this->get_all_loan_products();
        $this->borrowers = User::role('user')->without('applications')->get();
        return view('livewire.dashboard.loans.new-loan-view')
        ->layout('layouts.main');
    }
}
