<?php

namespace App\Http\Livewire\Dashboard\SiteSettings;

use App\Models\DisbursedBy;
use App\Models\Institution;
use App\Traits\LoanTrait;
use App\Traits\SettingTrait;
use App\Models\LoanAccountPayment;
use App\Models\LoanChildType;
use App\Models\LoanDecimalPlace;
use App\Models\LoanDisbursedBy;
use App\Models\LoanInterestMethod;
use App\Models\LoanInterestType;
use App\Models\LoanProduct;
use App\Models\LoanRepaymentCycle;
use App\Models\LoanRepaymentOrder;
use App\Models\LoanStatus;
use App\Models\LoanType;
use App\Models\Penalty;
use App\Models\RepaymentCycle;
use App\Models\RepaymentOrder;
use App\Models\ServiceCharge;
use App\Models\User;
use App\Traits\CRBTrait;
use App\Traits\DisbursementTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SystemItemSettings extends Component
{
    use SettingTrait, LoanTrait, DisbursementTrait, CRBTrait;
    public $settings, $title, $subtitle, $current_conf, $borrowers;
    public $crb_response, $crb;
    public $loan_products, $disbursements, $repayment_cycles, $penalties, $loan_fees,$institutions;
    public $loan_types, $loan_categories;
    public function render()
    {
        $this->settings = $_GET['settings'];
        $this->current_conf = $this->current_configs($_GET['settings']);
        $this->loan_products = $this->get_all_loan_products();
        $this->disbursements = $this->get_all_disbursement_methods();
        $this->repayment_cycles = $this->get_all_repayment_cycle();
        $this->penalties = $this->get_all_penalties();
        $this->loan_fees = $this->get_all_loan_fees();
        $this->institutions = Institution::where('status', 1)->get();
        $this->borrowers = User::role('user')->get();
        $this->loan_types = LoanType::get();
        $this->loan_categories = LoanChildType::with('loan_type')->get();
        return view('livewire.dashboard.site-settings.system-item-settings')
        ->layout('layouts.main');
    }

    public function CheckCRB()
    {
        $user = User::where('id', $this->crb)->first();
        $response = $this->soapApiCRBRequest('104', $user);
        dd($response);
    }

    // System Setting Delete Functions
    public function deleteLoanProduct($id){
        try {
            LoanDisbursedBy::where('loan_product_id', $id)->delete();
            LoanInterestMethod::where('loan_product_id', $id)->delete();
            LoanInterestType::where('loan_product_id', $id)->delete();
            LoanRepaymentCycle::where('loan_product_id', $id)->delete();
            LoanDecimalPlace::where('loan_product_id', $id)->delete();
            LoanAccountPayment::where('loan_product_id', $id)->delete();
            LoanAccountPayment::where('loan_product_id', $id)->delete();
            LoanStatus::where('loan_product_id', $id)->delete();
            LoanProduct::where('id', $id)->first()->delete();
            Session::flash('success', "Loan product deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-types']);
        } catch (\Throwable $th) {
            Session::flash('error', "Loan product deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-types']);
        }
    }

    public function deleteRepaymentCycle($id){
        try {
            RepaymentCycle::where('id', $id)->delete();
            Session::flash('success', "Repayment Cycle deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-repayment-cycle']);
        } catch (\Throwable $th) {
            Session::flash('success', "Repayment Cycle deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-repayment-cycle']);
        }
    }
    public function deletePenalty($id){
        try {
            Penalty::where('id', $id)->delete();
            Session::flash('success', "Penalty deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-penalty-settings']);
        } catch (\Throwable $th) {
            Session::flash('success', "Penalty deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-penalty-settings']);
        }
    }
    public function deleteDisbursement($id){
        try {
            DisbursedBy::where('id', $id)->delete();
            Session::flash('success', "Disbursement method deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-disbursements']);
        } catch (\Throwable $th) {
            Session::flash('success', "Disbursement method deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-disbursements']);
        }
    }
    public function deleteLoanFee($id){
        try {
            ServiceCharge::where('id', $id)->delete();
            Session::flash('success', "Loan Fee deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']);
        } catch (\Throwable $th) {
            Session::flash('error', "Loan Fee deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']);
        }
    }

    public function deleteInstitute($id){
        try {
            Institution::where('id', $id)->delete();
            Session::flash('success', "Institution deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']);
        } catch (\Throwable $th) {
            Session::flash('error', "Institution deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']);
        }
    }

    public function deleteLoanType($id){
        try {
            LoanType::where('id', $id)->delete();
            Session::flash('success', "Loan type deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-parent-types']);
        } catch (\Throwable $th) {
            Session::flash('error', "Loan type deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-parent-types']);
        }
    }

    public function deleteLoanCategory($id){
        try {
            LoanChildType::where('id', $id)->delete();
            Session::flash('success', "Loan category deleted successfully.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-categories']);
        } catch (\Throwable $th) {
            Session::flash('error', "Loan category deleted failed.");
            return redirect()->route('item-settings', ['confg' => 'loan','settings' => 'loan-categories']);
        }
    }

}
