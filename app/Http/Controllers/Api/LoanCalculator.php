<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LoanProduct;
use App\Traits\CalculatorTrait;
use App\Traits\CRBTrait;
use Illuminate\Http\JsonResponse;

class LoanCalculator extends Controller
{
    use CRBTrait, CalculatorTrait;

    public function calculateLoan(Request $request){
        try {

            $lp = $this->get_loan_product($request->loan_product_id);

            $loan_interest_method = $lp->loan_interest_method;
            // dd($loan_interest_method);
            switch ($loan_interest_method) {
                case 'Flat Rate':
                    // Perform calculation for flat rate interest
                    // You can define a separate method for this calculation
                    return $this->calculateFlatRate($request);
                    break;
                case 'Reducing Balance - Equal Installments':
                    // Perform calculation for reducing balance with equal installment interest
                    // You can define a separate method for this calculation
                    return $this->calculateReducingBalanceEqualInstallment($request);
                    break;
                default:
                    // Handle other cases or show an error message
                    return $this->calculateFlatRate($request);
                    break;
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function calculateReducingBalanceEqualInstallment($request):JsonResponse
    {
        // dd($request->loan_duration_period);
        $lp = $this->get_loan_product($request->loan_product_id);
        $loan_interest_value = $lp->def_loan_interest / 100;
        try {
            // Convert loan duration to months if it's not already in months
            switch ($request->loan_duration_period) {
                case 'day':
                    $loan_term = (int)$request->loan_duration_value / 30; // Assuming 30 days per month
                    break;
                case 'week':
                    $loan_term = (int)$request->loan_duration_value * 4; // Assuming 4 weeks per month
                    break;
                case 'year':
                    $loan_term = (int)$request->loan_duration_value * 12; // 12 months in a year
                    break;
                default:
                    $loan_term = (int)$request->loan_duration_value;
                    break;
            }

            $release_date = Carbon::parse($request->release_date);
            $monthly_interest_rate = (float)$loan_interest_value / 100;
            $monthly_installment = ($request->principal * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, -$loan_term));
            $loan_balance = $request->principal;

            $total_principal = 0;
            $total_interest = 0;
            $total_due = 0;

            $amortization_table = ['installments' => []];

            for ($i = 1; $i <= (int)$request->minimum_num_of_repayments; $i++) {
                $due_date = $release_date->copy()->addMonths($i);
                $interest = $loan_balance * $monthly_interest_rate;
                $principal = $monthly_installment - $interest;
                $loan_balance -= $principal;

                $total_principal += $principal;
                $total_interest += $interest;
                $total_due += $monthly_installment;

                $amortization_table['installments'][] = [
                    'due_date' => $due_date->format('d/m/Y'),
                    'principal' => number_format($principal, 2),
                    'interest' => number_format($interest, 2),
                    'fee_amount' => '0',
                    'penalty' => '0',
                    'due' => number_format($monthly_installment, 2),
                    'principal_balance' => number_format($loan_balance, 2),
                    'description' => ($loan_balance <= 0) ? 'Maturity' : 'Repayment',
                ];
            }

            // Add totals to the response
            $totals = [
                'total_principal' => number_format($total_principal, 2),
                'total_interest' => number_format($total_interest, 2),
                'total_due' => number_format($total_due, 2)
            ];

            return response()->json([
                'data' => [
                    'amortization_table' => $amortization_table,
                    'totals' => $totals
                ]
            ]);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function calculateFlatRate($request): JsonResponse
    {

        $lp = $this->get_loan_product($request->loan_product_id);
        $loan_interest_value = $lp->def_loan_interest / 100;
        try {
            // Convert loan duration to months if it's not already in months
            switch ($request->loan_duration_period) {
                case 'day':
                    $loan_term = $request->loan_duration_value / 30; // Assuming 30 days per month
                    break;
                case 'week':
                    $loan_term = $request->loan_duration_value * 4; // Assuming 4 weeks per month
                    break;
                case 'year':
                    $loan_term = $request->loan_duration_value * 12; // 12 months in a year
                    break;
                default:
                    $loan_term = $request->loan_duration_value;
                    break;
            }

            // Initialize amortization table
            $amortization_table = [];

            // Initialize loan balance
            $loan_balance = $request->principal;

            // Calculate total interest
            $total_interest = $request->principal * ($loan_interest_value / 100 * $loan_term);

            // Calculate total repayment amount
            $total_repayment_amount = $request->principal + $total_interest;

            // Get the release date and convert it to a Carbon instance
            $release_date = Carbon::parse($request->release_date);

            // Add loan details to the amortization table
            $amortization_table['loan_details'] = [
                'loan_product' => $request->lp->name,
                'loan_terms' => 'Principal: K' . number_format($request->principal, 2),
                'loan_release_date' => $release_date->format('d/m/Y'),
                'interest' => 'Flat Rate',
                'loan_interest' => $lp->def_loan_interest . '% per month',
                'duration' => $request->loan_duration_value . ' months',
                'repayment_cycle' => $request->loan_repayment_cycle,
                'num_of_repayments' => $request->minimum_num_of_repayments,
            ];

            // Initialize totals
            $total_principal = 0;
            $total_interest_amount = 0;

            // Loop through each period and calculate interest, principal, and remaining balance
            for ($i = 1; $i <= $request->minimum_num_of_repayments; $i++) {
                // Calculate due date based on the release date
                $due_date = $release_date->copy()->addMonths($i);

                // Calculate interest for the current period
                $interest = $request->principal * ($loan_interest_value / 100);

                // Calculate principal for the current period
                $principal = $request->principal / $request->minimum_num_of_repayments;

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

            // Prepare response data
            $response_data = [
                'amortization_table' => $amortization_table,
                'total_repayment_amount' => number_format($total_repayment_amount, 2),
            ];

            // dd($response_data);
            return response()->json(['data' => $response_data]);
        } catch (\Throwable $th) {
            // Return error response
            return response()->json([
                'error' => 'An error occurred while calculating the flat rate.',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}

