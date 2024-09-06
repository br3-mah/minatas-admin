<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Models\LoanProduct;
use App\Models\LoanType;
use App\Models\LoanCategory;
use App\Models\LoanChildType;
use App\Models\LoanStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Traits\LoanTrait;
use Livewire\Component;

class CreateLoanView extends Component
{
    use AuthorizesRequests, LoanTrait;

    public $users, $user_basic_pay, $user_net_pay;
    public $loan_products = [], $loan_products_stages = [], $loan_types, $loan_child_types = [], $borrowers;
    public $selectedLoanType = null, $selectedLoanCategory = null, $selectedLoanProduct = null;

    public function mount()
    {
        $this->loan_types = LoanType::all();
        $this->borrowers = User::role('user')
        ->whereDoesntHave('loans')
        ->orWhereHas('loans', function($query) {
            $query->where('closed', 1);
        })
        ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.loans.create-loan-view')->layout('layouts.main');
    }

    public function updatedSelectedLoanType($loanTypeId)
    {
        $this->loan_child_types = LoanChildType::where('loan_type_id', $loanTypeId)->get();
        $this->selectedLoanCategory = null; // Reset selected loan category
        $this->loan_products = []; // Reset loan products when loan type changes
    }

    public function updatedSelectedLoanCategory($loanCategoryId)
    {
        $this->loan_products = LoanProduct::where('loan_child_type_id', $loanCategoryId)->where('status', 1)->get();
        
    }    
    
    public function updatedSelectedLoanProduct($id)
    {
        $this->loan_products_stages = LoanStatus::with('status')->where('loan_product_id', $id)->get();

        // dd($this->loan_products_stages);
    }
}
