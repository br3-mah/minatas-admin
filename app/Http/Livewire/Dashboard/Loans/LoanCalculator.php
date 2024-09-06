<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;
use App\Traits\LoanTrait;
use App\Models\InterestMethod;
use App\Models\InterestType;
use App\Models\DisbursedBy;
use App\Models\RepaymentCycle;
use App\Models\RepaymentOrder;
use App\Models\AccountPayment;
use App\Models\ServiceCharge;
use App\Models\Institution;
use App\Models\CrbProduct;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoanCalculator extends Component
{
    use LoanTrait, AuthorizesRequests;

    public $principal;
    public $release_date;
    public $loan_interest_method = 'Flat Rate';
    public $loan_interest_type = 1;
    public $loan_interest_value;
    public $loan_interest_period;
    public $loan_duration_period;
    public $minimum_num_of_repayments = 1;
    public $loan_duration_value = 1;
    public $loan_repayment_cycle = 'Daily';
    public $amortization_table;
    public $total_repayment_amount;
    public $loan_product_id;
    // Declare public properties for the models
    public $interest_methods;
    public $interest_types;
    public $repayment_cycles;
    public $lp;

    public function render()
    {
        // $this->authorize('view calculator');
        $this->interest_methods = InterestMethod::get();
        $this->interest_types = InterestType::get();
        $this->repayment_cycles = RepaymentCycle::get();
        return view('livewire.dashboard.loans.loan-calculator')->layout('layouts.main');
    }

    public function prefillLoanProductValues(){
        $this->lp = $this->get_loan_product($this->loan_product_id);
        $this->loan_interest_value =$this->lp->def_loan_interest / 100;
        $this->principal = $this->lp->def_loan_amount ?? 0;
    }
    // Method to increase the loan interest value
    public function increaseDurationValue()
    {
        $this->loan_duration_value++;
        $this->increaseRepayments();
        $this->convertTime();

    }
    // Method to decrease the loan interest value
    public function decreaseDurationValue()
    {
        // Check if the value is greater than 0 before decrementing
        if ($this->loan_duration_value > 0) {
            $this->loan_duration_value--;
            $this->decreaseRepayments();
            $this->convertTime();
        }
    }

    // Method to increase the minimum number of repayments
    public function increaseRepayments()
    {
        $this->minimum_num_of_repayments++;
    }

    // Method to decrease the minimum number of repayments
    public function decreaseRepayments()
    {
        // Check if the value is greater than 0 before decrementing
        if ($this->minimum_num_of_repayments > 0) {
            $this->minimum_num_of_repayments--;
        }
    }

    public function updateLoanDurationPeriod()
    {
        $this->convertTime();
    }

    public function convertTime(){
        // Determine the loan duration period
        switch ($this->loan_duration_period) {
            case 'day':
                // Handle loan duration specified in days
                switch ($this->loan_repayment_cycle) {
                    case 'Daily':
                        // Minimum number of repayments equals the loan duration value (days)
                        $this->minimum_num_of_repayments = $this->loan_duration_value;
                        break;
                    case 'Weekly':
                        // Convert days to weeks for weekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / 7;
                        break;
                    case 'Biweekly':
                        // Convert days to biweeks for biweekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / 14;
                        break;
                    case 'Bimonthly':
                        // Convert days to bimonths for bimonthly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / (30 * 2);
                        break;
                    case 'Quarterly':
                        // Convert days to quarters for quarterly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / (30 * 3);
                        break;
                    default:
                        // Handle default case
                        break;
                }
                break;
            case 'week':
                // Handle loan duration specified in weeks
                switch ($this->loan_repayment_cycle) {
                    case 'Daily':
                        // Convert weeks to days for daily repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 7;
                        break;
                    case 'Weekly':
                        // Minimum number of repayments equals the loan duration value (weeks)
                        $this->minimum_num_of_repayments = $this->loan_duration_value;
                        break;
                    case 'Biweekly':
                        // Convert weeks to biweeks for biweekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / 2;
                        break;
                    case 'Bimonthly':
                        // Convert weeks to bimonths for bimonthly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / (4 * 2);
                        break;
                    case 'Quarterly':
                        // Convert weeks to quarters for quarterly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value / (4 * 3);
                        break;
                    default:
                        // Handle default case
                        break;
                }
                break;
            case 'month':
                // Handle loan duration specified in months
                switch ($this->loan_repayment_cycle) {
                    case 'Daily':
                        // Convert months to days for daily repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 30;
                        break;
                    case 'Weekly':
                        // Convert months to weeks for weekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 4;
                        break;
                    case 'Biweekly':
                        // Convert months to biweeks for biweekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 2;
                        break;
                    case 'Monthly':
                        // Minimum number of repayments equals the loan duration value (months)
                        $this->minimum_num_of_repayments = $this->loan_duration_value;
                        break;
                    default:
                        // Default conversion to days
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 30;
                        break;
                }
                break;
            case 'year':
                // Handle loan duration specified in years
                switch ($this->loan_repayment_cycle) {
                    case 'Daily':
                        // Convert years to days for daily repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 365;
                        break;
                    case 'Weekly':
                        // Convert years to weeks for weekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 52;
                        break;
                    case 'Biweekly':
                        // Convert years to biweeks for biweekly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 26;
                        break;
                    case 'Bimonthly':
                        // Convert years to bimonths for bimonthly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 6;
                        break;
                    case 'Quarterly':
                        // Convert years to quarters for quarterly repayment cycle
                        $this->minimum_num_of_repayments = $this->loan_duration_value * 4;
                        break;
                    default:
                        // Handle default case
                        break;
                }
                break;
            default:
                // Handle default case
                break;
        }
    }



    // Add this method to your Livewire component

public function calculateLoan()
{
    try {
        switch ($this->loan_interest_method) {
            case 'Flat Rate':
                // Perform calculation for flat rate interest
                // You can define a separate method for this calculation
                $this->calculateFlatRate();
                break;
            case 'Reducing Balance - Equal Installments':
                // Perform calculation for reducing balance with equal installment interest
                // You can define a separate method for this calculation
                $this->calculateReducingBalanceEqualInstallment();
                break;
            case 'Reducing Balance - Equal Principal':
                // Perform calculation for reducing balance with equal principal interest
                // You can define a separate method for this calculation
                $this->calculateReducingBalanceEqualPrincipal();
                break;
            case 'Interest-Only':
                // Perform calculation for interest only interest
                // You can define a separate method for this calculation
                $this->calculateInterestOnly();
                break;
            case 'Compound Interest':
                // Perform calculation for compound interest
                // You can define a separate method for this calculation
                $this->calculateCompoundInterest();
                break;
            default:
                // Handle other cases or show an error message
                break;
        }
    } catch (\Throwable $th) {
        dd($th);
    }
}

private function calculateFlatRate(){
    try {
        // Convert loan duration to months if it's not already in months
        switch ($this->loan_duration_period) {
            case 'day':
                $loan_term = $this->loan_duration_value / 30; // Assuming 30 days per month
                break;
            case 'week':
                $loan_term = $this->loan_duration_value * 4; // Assuming 4 weeks per month
                break;
            case 'year':
                $loan_term = $this->loan_duration_value * 12; // 12 months in a year
                break;
            default:
                $loan_term = $this->loan_duration_value;
                break;
        }

        // Initialize amortization table
        $amortization_table = [];

        // Initialize loan balance
        $loan_balance = $this->principal;

        // Calculate total interest
        $total_interest = $this->principal * ($this->loan_interest_value / 100 * $loan_term);

        // Calculate total repayment amount
        $total_repayment_amount = $this->principal + $total_interest;

        // Get the release date and convert it to a Carbon instance
        $release_date = Carbon::parse($this->release_date);

        // Add loan details to the amortization table
        $amortization_table['loan_details'] = [
            'loan_product' => $this->lp->name,
            'loan_terms' => 'Principal: K' . number_format($this->principal, 2),
            'loan_release_date' => $release_date->format('d/m/Y'),
            'interest' => 'Flat Rate',
            'loan_interest' => $this->loan_interest_value . '% per month',
            'duration' => $this->loan_duration_value . ' months',
            'repayment_cycle' => $this->loan_repayment_cycle,
            'num_of_repayments' => $this->minimum_num_of_repayments,
        ];

        // Initialize totals
        $total_principal = 0;
        $total_interest_amount = 0;

        // Loop through each period and calculate interest, principal, and remaining balance
        for ($i = 1; $i <= $this->minimum_num_of_repayments; $i++) {
            // Calculate due date based on the release date
            $due_date = $release_date->copy()->addMonths($i);

            // Calculate interest for the current period
            $interest = $this->principal * ($this->loan_interest_value / 100);

            // Calculate principal for the current period
            $principal = $this->principal / $this->minimum_num_of_repayments;

            // Update totals
            $total_principal += $principal;
            $total_interest_amount += $interest;

            // Update loan balance
            $loan_balance -= $principal;

            // Add current period's data to amortization table
            $amortization_table['installments'][] = [
                'due_date' => $due_date->format('d/m/Y'),
                'principal' => 'K' . number_format($principal, 2),
                'interest' => 'K' . number_format($interest, 2),
                'fee_amount' => 'K0',
                'penalty' => 'K0',
                'due' => 'K' . number_format($principal + $interest, 2),
                'principal_balance' => 'K' . number_format($loan_balance, 2),
                'description' => ($loan_balance <= 0) ? 'Maturity' : 'Repayment',
            ];
        }

        // Add totals row
        $amortization_table['installments'][] = [
            'due_date' => 'Total',
            'principal' => 'K' . number_format($total_principal, 2),
            'interest' => 'K' . number_format($total_interest_amount, 2),
            'fee_amount' => 'K0',
            'penalty' => 'K0',
            'due' => 'K' . number_format($total_principal + $total_interest_amount, 2),
            'principal_balance' => '', // leave blank for totals row
            'description' => '', // leave blank for totals row
        ];

        // Store amortization table in a public property for wire model bindings
        $this->amortization_table = $amortization_table;

        // Store total repayment amount in a public property
        $this->total_repayment_amount = number_format($total_repayment_amount, 2);
    } catch (\Throwable $th) {
        dd($th);
    }
}

private function calculateReducingBalanceEqualInstallment()
{
    try {
        // Convert loan duration to months if it's not already in months
        switch ($this->loan_duration_period) {
            case 'day':
                $loan_term = $this->loan_duration_value / 30; // Assuming 30 days per month
                break;
            case 'week':
                $loan_term = $this->loan_duration_value * 4; // Assuming 4 weeks per month
                break;
            case 'year':
                $loan_term = $this->loan_duration_value * 12; // 12 months in a year
                break;
            default:
                $loan_term = $this->loan_duration_value;
                break;
        }

        // Initialize amortization table
        $amortization_table = [
            'installments' => [],
        ];

        // Get the release date and convert it to a Carbon instance
        $release_date = Carbon::parse($this->release_date);

        // Calculate monthly interest rate
        $monthly_interest_rate = $this->loan_interest_value / 100;

        // Calculate total number of installments
        $total_installments = $this->minimum_num_of_repayments;

        // Calculate monthly installment using reducing balance method
        $monthly_installment = ($this->principal * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, -$total_installments));

        // Initialize loan balance
        $loan_balance = $this->principal;

        // Initialize total amounts
        $total_principal = 0;
        $total_interest = 0;
        $total_due = 0;

        // Loop through each installment and calculate details
        for ($i = 1; $i <= $total_installments; $i++) {
            // Calculate due date based on the release date
            $due_date = $release_date->copy()->addMonths($i);

            // Calculate interest for the current installment
            $interest = $loan_balance * $monthly_interest_rate;

            // Calculate principal for the current installment
            $principal = $monthly_installment - $interest;

            // Update loan balance
            $loan_balance -= $principal;

            // Update total amounts
            $total_principal += $principal;
            $total_interest += $interest;
            $total_due += $monthly_installment;

            // Add current installment's data to amortization table
            $amortization_table['installments'][] = [
                'due_date' => $due_date->format('d/m/Y'),
                'principal' => 'K' . number_format($principal, 2),
                'interest' => 'K' . number_format($interest, 2),
                'fee_amount' => '0', // Assuming no fees
                'penalty' => '0', // Assuming no penalties
                'due' => 'K' . number_format($monthly_installment, 2),
                'principal_balance' => 'K' . number_format($loan_balance, 2),
                'description' => ($loan_balance <= 0) ? 'Maturity' : 'Repayment',
            ];
        }

        // Add total row
        $amortization_table['installments'][] = [
            'due_date' => 'Total',
            'principal' => 'K' . number_format($total_principal, 2),
            'interest' => 'K' . number_format($total_interest, 2),
            'fee_amount' => '0',
            'penalty' => '0',
            'due' => 'K' . number_format($total_due, 2),
            'principal_balance' => '', // Leave blank for totals row
            'description' => '', // Leave blank for totals row
        ];

        // Store amortization table in a public property for Livewire model bindings
        $this->amortization_table = $amortization_table;

        // Calculate total repayment amount
        $this->total_repayment_amount = number_format($total_due, 2);
    } catch (\Throwable $th) {
        dd($th);
    }
}

// private function calculateReducingBalanceEqualInstallment()
// {
//     try {
//         // Initialize amortization table
//         $amortization_table = [
//             'installments' => [],
//         ];

//         // Get the release date and convert it to a Carbon instance
//         $release_date = Carbon::parse($this->release_date);

//         // Calculate monthly interest rate
//         $monthly_interest_rate = $this->loan_interest_value / 100;

//         // Calculate total number of installments
//         $total_installments = $this->minimum_num_of_repayments;

//         // Calculate monthly installment using reducing balance method
//         $monthly_installment = ($this->principal * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, -$total_installments));

//         // Initialize loan balance
//         $loan_balance = $this->principal;

//         // Initialize total amounts
//         $total_principal = 0;
//         $total_interest = 0;
//         $total_due = 0;

//         // Loop through each installment and calculate details
//         for ($i = 1; $i <= $total_installments; $i++) {
//             // Calculate due date based on the release date
//             $due_date = $release_date->copy()->addMonths($i);

//             // Calculate interest for the current installment
//             $interest = $loan_balance * $monthly_interest_rate;

//             // Calculate principal for the current installment
//             $principal = $monthly_installment - $interest;

//             // Update loan balance
//             $loan_balance -= $principal;

//             // Update total amounts
//             $total_principal += $principal;
//             $total_interest += $interest;
//             $total_due += $monthly_installment;

//             // Add current installment's data to amortization table
//             $amortization_table['installments'][] = [
//                 'due_date' => $due_date->format('d/m/Y'),
//                 'principal' => 'K' . number_format($principal, 2),
//                 'interest' => 'K' . number_format($interest, 2),
//                 'fee_amount' => '0', // Assuming no fees
//                 'penalty' => '0', // Assuming no penalties
//                 'due' => 'K' . number_format($monthly_installment, 2),
//                 'principal_balance' => 'K' . number_format($loan_balance, 2),
//                 'description' => ($loan_balance <= 0) ? 'Maturity' : 'Repayment',
//             ];
//         }

//         // Add total row
//         $amortization_table['installments'][] = [
//             'due_date' => 'Total',
//             'principal' => 'K' . number_format($total_principal, 2),
//             'interest' => 'K' . number_format($total_interest, 2),
//             'fee_amount' => '0',
//             'penalty' => '0',
//             'due' => 'K' . number_format($total_due, 2),
//             'principal_balance' => '', // Leave blank for totals row
//             'description' => '', // Leave blank for totals row
//         ];

//         // Store amortization table in a public property for Livewire model bindings
//         $this->amortization_table = $amortization_table;

//         // Calculate total repayment amount
//         $this->total_repayment_amount = number_format($total_due, 2);
//     } catch (\Throwable $th) {
//         dd($th);
//     }
// }


private function calculateReducingBalanceEqualPrincipal()
{
    try {
        // Initialize amortization table
        $amortization_table = [
            'installments' => [],
        ];

        // Get the release date and convert it to a Carbon instance
        $release_date = Carbon::parse($this->release_date);

        // Calculate monthly interest rate
        $monthly_interest_rate = $this->loan_interest_value / 100;

        // Calculate total number of installments
        $total_installments = $this->minimum_num_of_repayments;

        // Initialize loan balance
        $loan_balance = $this->principal;

        // Initialize total amounts
        $total_principal = 0;
        $total_interest = 0;
        $total_due = 0;

        // Loop through each installment and calculate details
        for ($i = 1; $i <= $total_installments; $i++) {
            // Calculate due date based on the release date
            $due_date = $release_date->copy()->addMonths($i);

            // Calculate principal for the current installment
            $principal = $this->principal / $total_installments;

            // Calculate interest for the current installment
            $interest = $loan_balance * $monthly_interest_rate;

            // Update loan balance
            $loan_balance -= $principal;

            // Update total amounts
            $total_principal += $principal;
            $total_interest += $interest;
            $total_due += $principal + $interest;

            // Add current installment's data to amortization table
            $amortization_table['installments'][] = [
                'due_date' => $due_date->format('d/m/Y'),
                'principal' => 'K' . number_format($principal, 2),
                'interest' => 'K' . number_format($interest, 2),
                'fee_amount' => '0', // Assuming no fees
                'penalty' => '0', // Assuming no penalties
                'due' => 'K' . number_format($principal + $interest, 2),
                'principal_balance' => 'K' . number_format($loan_balance, 2),
                'description' => ($loan_balance <= 0) ? 'Maturity' : 'Repayment',
            ];
        }

        // Add total row
        $amortization_table['installments'][] = [
            'due_date' => 'Total',
            'principal' => 'K' . number_format($total_principal, 2),
            'interest' => 'K' . number_format($total_interest, 2),
            'fee_amount' => '0',
            'penalty' => '0',
            'due' => 'K' . number_format($total_due, 2),
            'principal_balance' => '', // Leave blank for totals row
            'description' => '', // Leave blank for totals row
        ];

        // Store amortization table in a public property for Livewire model bindings
        $this->amortization_table = $amortization_table;

        // Calculate total repayment amount
        $this->total_repayment_amount = number_format($total_due, 2);
    } catch (\Throwable $th) {
        dd($th);
    }
}

private function calculateInterestOnly()
{
    try {
        // Initialize amortization table
        $amortization_table = [
            'installments' => [],
        ];

        // Get the release date and convert it to a Carbon instance
        $release_date = Carbon::parse($this->release_date);

        // Calculate monthly interest rate
        $monthly_interest_rate = $this->loan_interest_value / 100;

        // Calculate total number of installments
        $total_installments = $this->minimum_num_of_repayments;

        // Initialize total amounts
        $total_interest = 0;
        $total_due = 0;

        // Loop through each installment and calculate details
        for ($i = 1; $i <= $total_installments; $i++) {
            // Calculate due date based on the release date
            $due_date = $release_date->copy()->addMonths($i);

            // Calculate interest for the current installment
            $interest = $this->principal * $monthly_interest_rate;

            // Set principal balance to 0 for all installments except the last one
            $principal_balance = ($i === $total_installments) ? $this->principal + $interest : 0.00;

            // Add principal balance to the due amount for the last installment
            $due_amount = $interest + $principal_balance;

            // Update total amounts
            $total_interest += $interest;
            $total_due += $due_amount;

            // Add current installment's data to amortization table
            $amortization_table['installments'][] = [
                'due_date' => $due_date->format('d/m/Y'),
                'principal' => '0.00', // Principal is zero for interest-only loans
                'interest' => 'K' . number_format($interest, 2),
                'fee_amount' => '0', // Assuming no fees
                'penalty' => '0', // Assuming no penalties
                'due' => 'K' .  number_format($due_amount, 2), // Include principal balance in due amount for the last installment
                'principal_balance' => 'K' . number_format($principal_balance, 2), // Principal balance remains the same
                'description' => ($i === $total_installments) ? 'Maturity' : 'Repayment',
            ];
        }

        // Add total row
        $amortization_table['installments'][] = [
            'due_date' => 'Total',
            'principal' => '0.00',
            'interest' => 'K' . number_format($total_interest, 2),
            'fee_amount' => '0',
            'penalty' => '0',
            'due' => 'K' . number_format($total_due, 2),
            'principal_balance' => '', // Leave blank for totals row
            'description' => '', // Leave blank for totals row
        ];

        // Store amortization table in a public property for Livewire model bindings
        $this->amortization_table = $amortization_table;

        // Calculate total repayment amount
        $this->total_repayment_amount = number_format($total_due, 2);
    } catch (\Throwable $th) {
        dd($th);
    }
}

private function calculateCompoundInterest()
{
    try {
        // Use Livewire properties/variables to calculate compound interest
        $loan_duration_period = $this->loan_duration_period;
        $loan_duration_value = $this->loan_duration_value;
        $principal = $this->principal;
        $loan_interest_value = $this->loan_interest_value;

        // Convert loan duration to months if it's not already in months
        switch ($loan_duration_period) {
            case 'day':
                $loan_term = $loan_duration_value / 30; // Assuming 30 days per month
                break;
            case 'week':
                $loan_term = $loan_duration_value * 4; // Assuming 4 weeks per month
                break;
            case 'year':
                $loan_term = $loan_duration_value * 12; // 12 months in a year
                break;
            default:
                $loan_term = $loan_duration_value;
                break;
        }

        // Initialize amortization table
        $amortization_table = [];

        // Initialize loan balance
        $loan_balance = $principal;

        // Calculate monthly interest rate
        $monthly_interest_rate = $loan_interest_value / 100 / 12;

        // Initialize total interest
        $total_interest = 0;

        // Get the release date and convert it to a Carbon instance
        $release_date = Carbon::parse($this->release_date);

        // Calculate maturity date based on loan term
        $maturity_date = $release_date->copy()->addMonths($loan_term);

        // Add loan details to the amortization table
        $amortization_table['loan_details'] = [
            'released' => $release_date->format('d/m/Y'),
            'maturity' => $maturity_date->format('d/m/Y'),
            'repayment_frequency' => $this->loan_repayment_cycle,
            'principal' => number_format($principal, 2),
            'interest' => '0.00', // Will be calculated later
            'fees' => '0.00',
            'due' => '0.00', // Will be calculated later
        ];

        // Loop through each period and calculate interest, principal, and remaining balance
        for ($i = 1; $i <= $loan_term; $i++) {
            // Calculate due date based on the release date
            $due_date = $release_date->copy()->addMonths($i);

            // Calculate principal for the current period
            $principal_payment = ($i === $loan_term) ? $loan_balance : $principal;

            // Calculate interest for the current period
            $interest = $loan_balance * $monthly_interest_rate;

            // Update total interest
            $total_interest += $interest;

            // Update loan balance (principal + accumulated interest)
            $loan_balance += $interest;
            $loan_balance -= $principal_payment;

            // Add current period's data to amortization table
            $amortization_table['installments'][] = [
                'due_date' => $due_date->format('d/m/Y'),
                'principal' => number_format($principal_payment, 2),
                'interest' => number_format($interest, 2),
                'fees' => '0.00',
                'penalty' => '0.00',
                'due' => number_format($interest + $principal_payment, 2),
                'principal_balance' => number_format($loan_balance, 2),
                'description' => ($i === $loan_term) ? 'Maturity' : 'Repayment',
            ];
        }

        // Calculate total due amount
        $total_due = $principal + $total_interest;

        // Add total row
        $amortization_table['installments'][] = [
            'due_date' => 'Total',
            'principal' => number_format($principal, 2),
            'interest' => number_format($total_interest, 2),
            'fees' => '0.00',
            'penalty' => '0.00',
            'due' => number_format($total_due, 2),
            'principal_balance' => '', // Leave blank for totals row
            'description' => '', // Leave blank for totals row
        ];

        // Update total interest in the amortization table
        $amortization_table['loan_details']['interest'] = number_format($total_interest, 2);

        // Update total due amount in the amortization table
        $amortization_table['loan_details']['due'] = number_format($total_due, 2);

        // Store amortization table in a public property for wire model bindings
        $this->amortization_table = $amortization_table;
    } catch (\Throwable $th) {
        dd($th);
    }
}



}

