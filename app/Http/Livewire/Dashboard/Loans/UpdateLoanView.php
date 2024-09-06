<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Models\Application;
use App\Models\LoanProduct;
use App\Models\LoanType;
use App\Models\LoanChildType;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class UpdateLoanView extends Component
{
    public $loan;
    public $user;
    public $can_edit;
    public $loan_types;
    public $loan_child_types = [];
    public $loan_products = [];
    public $selectedLoanType = null;
    public $selectedLoanCategory = null;
    public $selectedLoanProduct = null;

    public function mount($id)
    {
        $this->loan = Application::with('user.party', 'user.guarantors')->findOrFail($id);
        $this->user = User::findOrFail($this->loan->user_id);
        $this->can_edit = Transaction::hasTransaction($id);
        $this->loan_types = LoanType::all();

        // Load initial categories and products
        if ($this->loan->loan_type_id) {
            $this->selectedLoanType = $this->loan->loan_type_id;
            $this->loadLoanCategories();
            if ($this->loan->loan_child_type_id) {
                $this->selectedLoanCategory = $this->loan->loan_child_type_id;
                $this->loadLoanProducts();
                if ($this->loan->loan_product_id) {
                    $this->selectedLoanProduct = $this->loan->loan_product_id;
                }
            }
        }
    }

    public function updatedSelectedLoanType()
    {
        $this->loadLoanCategories();
        $this->loan_products = []; // Reset loan products when loan type changes
        $this->selectedLoanCategory = null; // Reset selected loan category
        $this->selectedLoanProduct = null; // Reset selected loan product
    }

    public function updatedSelectedLoanCategory()
    {
        $this->loadLoanProducts();
        $this->selectedLoanProduct = null; // Reset selected loan product
    }

    public function loadLoanCategories()
    {
        if ($this->selectedLoanType) {
            $this->loan_child_types = LoanChildType::where('loan_type_id', $this->selectedLoanType)->get();
        } else {
            $this->loan_child_types = [];
        }
    }

    public function loadLoanProducts()
    {
        if ($this->selectedLoanCategory) {
            $this->loan_products = LoanProduct::where('loan_child_type_id', $this->selectedLoanCategory)->get();
        } else {
            $this->loan_products = [];
        }
    }

    public function render()
    {
        return view('livewire.dashboard.loans.update-loan-view')
            ->layout('layouts.main');
    }
}
