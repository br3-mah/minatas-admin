<?php

namespace App\Http\Livewire\Dashboard\SiteSettings;

use App\Models\AccountPayment;
use App\Models\DisbursedBy;
use App\Models\Institution;
use App\Models\InterestMethod;
use App\Models\InterestType;
use App\Models\LoanAccountPayment;
use App\Models\LoanDecimalPlace;
use App\Models\LoanDisbursedBy;
use App\Models\LoanInterestMethod;
use App\Models\LoanInterestType;
use App\Models\LoanProduct;
use App\Models\LoanProductInstitution;
use App\Models\LoanRepaymentCycle;
use App\Models\LoanRepaymentOrder;
use App\Models\LoanServiceCharge;
use App\Models\Penalty;
use App\Models\CrbProduct;
use App\Models\LoanChildType;
use App\Models\LoanCrbProduct;
use App\Models\LoanType;
use App\Models\RepaymentCycle;
use App\Models\RepaymentOrder;
use App\Models\ServiceCharge;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CreateSetting extends Component
{
    public $page;

    // Preset Data
    public $interest_methods, $interest_types, $disbursements, $repayment_cycles;
    public $repayment_orders, $decimal_places, $company_accounts, $service_charges;
    public $loan_institute_name,$loan_institute_type;

    //Loan Type
    public $loan_category_name, $loan_category_desc, $loan_type_name, $loan_type_desc, $loan_type_id, $loan_child_type_id;
    public $loan_types = [], $loan_categories = [], $loan_child_types;
    public $selectedLoanCategory = null, $selectedLoanType = null;

    // Loan Product
    public $new_loan_name, $loan_release_date, $minimum_loan_principal_amount, $default_loan_principal_amount, $maximum_principal_amount, $loan_interest_method, $loan_interest_type;
    public $loan_interest_period, $minimum_loan_interest, $default_loan_interest, $maximum_loan_interest, $loan_duration_period, $minimum_loan_duration;
    public $default_loan_duration, $maximum_loan_duration, $default_num_of_repayments, $maximum_num_of_repayments, $minimum_num_of_repayments;
    public $loan_decimal_place, $add_automatic_payments, $new_loan_desc, $new_loan_icon, $new_loan_icon_alt, $num_of_steps;
    public $auto_payment_sources = [];
    public $loan_disbursed_by = [];
    public $loan_repayment_cycle = [];
    public $extra_fees = [];
    public $loan_institution = [];

    // Disbursements
    public $disbursement_name, $penalty_name, $penalty_amount, $penalty_grace, $repayment_cycle_name;
    public $loan_charge_name, $loan_charge_amount, $institutions;
    public $sector;

    public $crb_products;
    public $crb_selected_products = [];

    public function render()
    {
        $this->page = $_GET['page'];
        $this->get_data();
        return view('livewire.dashboard.site-settings.create-setting', [
            'loan_child_types' => $this->loan_child_types,
            'loan_types' => $this->loan_types
        ])->layout('layouts.main');
    }

    public function updatedSelectedLoanType($loanTypeId)
    {
        $this->loan_child_types = LoanChildType::where('loan_type_id', $loanTypeId)->get();
    }

    public function get_data(){
        $this->interest_methods =  InterestMethod::get();
        $this->interest_types = InterestType::get();
        $this->disbursements =  DisbursedBy::get();
        $this->repayment_cycles = RepaymentCycle::get();
        $this->repayment_orders = RepaymentOrder::get();
        $this->company_accounts = AccountPayment::get();
        $this->service_charges = ServiceCharge::get();
        $this->institutions = Institution::where('status', 1)->get();
        $this->crb_products = CrbProduct::get();
        $this->loan_types = LoanType::get();
        $this->loan_categories = LoanChildType::get();
    }

    public function updatedSector()
    {
        // dd('here');
        $this->updateInstitutions();
    }

    private function updateInstitutions()
    {
        if ($this->sector) {
            $this->institutions = Institution::where('status', 1)
                ->where('type', $this->sector)
                ->get();
        } else {
            // Handle the case where no sector is selected, you might want to reset the institutions to the default state
            $this->institutions = Institution::where('status', 1)->get();
        }
    }

    public function create_loan_product(){

        try {
            $loan_product = LoanProduct::Create([
                'name' => $this->new_loan_name,
                'description'=> $this->new_loan_desc,
                'icon'=> $this->new_loan_icon,
                'loan_child_type_id' => $this->loan_child_type_id,
                'icon_alt' => $this->new_loan_icon_alt,
                'wiz_steps' => $this->num_of_steps,
                'release_date' => $this->loan_release_date,
                'auto_payment' => $this->add_automatic_payments,
                'loan_duration_period'=>$this->loan_duration_period,
                'loan_interest_period'=>$this->loan_interest_period,

                'min_principal_amount' => $this->minimum_loan_principal_amount,
                'def_principal_amount' => $this->default_loan_principal_amount,
                'max_principal_amount' => $this->maximum_principal_amount,

                'min_loan_duration' => $this->minimum_loan_duration,
                'def_loan_duration' => $this->default_loan_duration,
                'max_loan_duration' => $this->maximum_loan_duration,

                'min_loan_interest' => $this->minimum_loan_interest,
                'def_loan_interest' => $this->default_loan_interest,
                'max_loan_interest' => $this->maximum_loan_interest,

                'min_num_of_repayments' => $this->minimum_num_of_repayments,
                'def_num_of_repayments' => $this->default_num_of_repayments,
                'max_num_of_repayments' => $this->maximum_num_of_repayments
            ]);

            // Replace rand() with respective Parent table Primary key IDs
            // Disbursed Bys ****Loop
            foreach ($this->loan_disbursed_by as $key => $value) {
                LoanDisbursedBy::Create([
                    'disbursed_by_id' => $value,
                    'loan_product_id' => $loan_product->id
                ]);
            }

            // Interest Methods
            LoanInterestMethod::Create([
                'interest_method_id' => $this->loan_interest_method,
                'loan_product_id' => $loan_product->id
            ]);

            // Interest Types
            LoanInterestType::Create([
                'interest_type_id' => $this->loan_interest_type,
                'loan_product_id' => $loan_product->id
            ]);

            // Repayment Cycles ****Loop
            foreach ($this->loan_repayment_cycle as $key => $value) {
                LoanRepaymentCycle::Create([
                    'repayment_cycle_id' => $value,
                    'loan_product_id' => $loan_product->id
                ]);
            }

            // Loan Decimal Places
            LoanDecimalPlace::Create([
                'value' => $this->loan_decimal_place,
                'loan_product_id' => $loan_product->id
            ]);

            // Loan Repayment Orders ****Loop
            // LoanRepaymentOrder::Create([
            //     'repayment_order_id' => rand(1, 12),
            //     'loan_product_id' => $loan_product->id
            // ]);

            // Loan Service Charges ****Loop
            foreach ($this->extra_fees as $key => $value) {
                LoanServiceCharge::Create([
                    'service_charge_id' => $value,
                    'loan_product_id' => $loan_product->id
                ]);
            }

            // Loan Automated Payments ****Loop
            foreach ($this->auto_payment_sources as $key => $value) {
                LoanAccountPayment::Create([
                    'account_payment_id' => $value,
                    'loan_product_id' => $loan_product->id
                ]);
            }
            // Institutions
            foreach ($this->loan_institution as $key => $value) {
                LoanProductInstitution::Create([
                    'institution_id' => $value,
                    'loan_product_id' => $loan_product->id
                ]);
            }
            // CRBs
            foreach ($this->crb_selected_products as $key => $value) {
                LoanCrbProduct::Create([
                    'crb_product_id' => $value,
                    'loan_product_id' => $loan_product->id
                ]);
            }

            Session::flash('success', "Loan product created successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-types']);

        } catch (\Throwable $th) {
            Session::flash('error', "Failed. ". $th->getMessage());
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-types']);
        }
    }



    // Create Disbursement
    public function create_disbursement(){
        try {
            DisbursedBy::Create([
                'name' => $this->disbursement_name,
                'tag' => strtolower(str_replace(' ', '-', $this->disbursement_name))
            ]);

            Session::flash('success', "Disbursement method created successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-disbursements']);

        } catch (\Throwable $th) {
            Session::flash('error', "Failed. ". $th->getMessage());
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-disbursements']);
        }
    }

    // Create Penalty
    public function create_penalty(){
        try {
            Penalty::Create([
                'name' => $this->penalty_name,
                'value' => $this->penalty_amount,
                'grace_period' => $this->penalty_grace,
                'tag' => strtolower(str_replace(' ', '-', $this->disbursement_name))
            ]);

            Session::flash('success', "Penalty created successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-penalty-settings']);

        } catch (\Throwable $th) {
            Session::flash('error', "Failed. ". $th->getMessage());
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-penalty-settings']);
        }
    }

    // Create repayment cycle
    public function create_repayment_cycle(){
        try {
            RepaymentCycle::Create([
                'name' => $this->repayment_cycle_name,
                'tag' => strtolower(str_replace(' ', '-', $this->repayment_cycle_name))
            ]);

            Session::flash('success', "Repayment Cycle created successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-repayment-cycle']);

        } catch (\Throwable $th) {
            Session::flash('error', "Failed. ". $th->getMessage());
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-repayment-cycle']);
        }
    }


    public function create_loan_fee(){
        try {
            ServiceCharge::Create([
                'name' => $this->loan_charge_name,
                'value' => $this->loan_charge_amount,
                'tag' => strtolower(str_replace(' ', '-', $this->loan_charge_name))
            ]);

            Session::flash('success', "Loan Fee created successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']);

        } catch (\Throwable $th) {
            Session::flash('error', "Failed. ". $th->getMessage());
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']);
        }
    }

    public function create_institution(){
        try {
            Institution::create([
                'name' => $this->loan_institute_name,
                'type' => $this->loan_institute_type
            ]);
            Session::flash('success', "Loan Institution created successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'institutes']);
        } catch (\Throwable $th) {
            Session::flash('error', "Failed. ". $th->getMessage());
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'institutes']);
        }
    }


    public function createLoanType()
    {
        try {
            // Validate the input data
            $validatedData = $this->validate([
                'loan_type_name' => 'required|string|max:255',
                'loan_type_desc' => 'nullable|string|max:1000',
            ]);
    
            // Save loan type data to the database
            LoanType::create([
                'name' => $validatedData['loan_type_name'],
                'description' => $validatedData['loan_type_desc'],
            ]);
    
            // Optionally, reset the form fields
            $this->reset(['loan_type_name', 'loan_type_desc']);
    
            // Provide feedback to the user
            session()->flash('success', 'Loan Type saved successfully.');
            return redirect()->route('item-settings', ['confg' => 'loan', 'settings' => 'loan-parent-types']);
        } catch (\Throwable $th) {
            // Provide feedback to the user
            session()->flash('error', 'Loan Type saving failed. ' . $th->getMessage());
        }
    }
    

    public function createLoanCategory()
    {
        try {
            // Validate input fields
            $validatedData = $this->validate([
                'loan_category_name' => 'required|string|max:255',
                'loan_category_desc' => 'nullable|string|max:500',
                'loan_type_id' => 'required|exists:loan_types,id',
            ]);
    
            // Save loan category data to the database
            LoanChildType::create([
                'name' => $validatedData['loan_category_name'],
                'description' => $validatedData['loan_category_desc'],
                'loan_type_id' => $validatedData['loan_type_id'],
            ]);
    
            // Optionally, reset the form fields
            $this->reset(['loan_category_name', 'loan_category_desc']);
    
            // Provide feedback to the user
            session()->flash('success', 'Loan Category saved successfully.');
            return redirect()->route('item-settings', ['confg' => 'loan', 'settings' => 'loan-categories']);
        } catch (\Throwable $th) {
            // Provide feedback to the user
            session()->flash('error', 'Loan Category saving failed. ' . $th->getMessage());
        }
    }
    
}
