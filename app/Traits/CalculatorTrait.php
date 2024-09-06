<?php

namespace App\Traits;

use App\Models\LoanProduct;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\File;
trait CalculatorTrait{

    use LoanTrait;
    public function calculateAmortizationSchedule($loanAmount, $loanTermYears, $loanProductId) {

        try {
            $info = $this->get_LoanProductDetails($loanProductId);

            switch ($info->interest_methods->first()->interest_method->name) {
                case 'Flat Rate':
                    return $this->flatRateAmortization($loanAmount, $loanTermYears, $info);
                    break;

                default:
                    # code...
                    break;
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    function flatRateAmortization($principal, $termMonths, $info) {
            $schedule = [];
            $monthlyInterestRate = $info->def_loan_interest / 100 / 12;
            $monthlyPayment = ($principal * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$termMonths));

            $remainingBalance = $principal;

            for ($i = 0; $i < $termMonths; $i++) {
                $interest = $remainingBalance * $monthlyInterestRate;
                $principalPayment = $monthlyPayment - $interest;
                $remainingBalance -= $principalPayment;

                $schedule[] = [
                    'month' => $i + 1,
                    'payment' => $monthlyPayment,
                    'principal' => $principalPayment,
                    'interest' => $interest,
                    'balance' => $remainingBalance
                ];
            }
            return $schedule;
    }


    public function calculateEqualInstallment(array $data){

        // API endpoint URL
        $api_url = 'https://admin.capexfinancialservices.org/api/calculate-reducing-balance';
        $lp = $this->get_loan_product($data['loan_product_id']);
        $loan_interest_value = $this->lp->def_loan_interest / 100;
        $principal = $lp->def_loan_amount ?? 0;
        // Sample request data
        $request_data = [
            'loan_duration_period' => $data['loan_duration_period'],
            'loan_duration_value' => $data['loan_duration_value'],
            'principal' => $data['principal'],
            'loan_interest_value' => $loan_interest_value,
            'minimum_num_of_repayments' => $data['num_of_repayments'],
            'release_date' => $data['release_date'],
        ];

        // dd($request_data);
        // Initialize curl
        $curl = curl_init();

        // Set curl options
        curl_setopt_array($curl, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request_data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        // Execute curl request
        $response = curl_exec($curl);

        // Check for errors
        if (curl_errno($curl)) {
            $error_message = curl_error($curl);
            echo "Error: $error_message";
        } else {
            // Decode the response JSON
            $response_data = json_decode($response, true);

            // dd($response_data);
            // Print response
            return $response_data;
        }

        // Close curl
        curl_close($curl);


    }


    // Getters
    public function get_LoanProductDetails($id){
        return LoanProduct::where('id', $id)->with([
            'disbursed_by.disbursed_by',
            'interest_methods.interest_method',
            'interest_types.interest_type',
            'loan_accounts.account_payment',
            'loan_status.status',
            'loan_decimal_places',
            'service_fees.service_charge',
            'loan_institutes.institutions'
        ])->first();
    }
}


