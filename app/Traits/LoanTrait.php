<?php

namespace App\Traits;


use App\Notifications\LoanRequestNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use App\Models\ApplicationStage;
use App\Models\LoanChildType;
use App\Models\LoanExpense;
use App\Models\LoanInstallment;
use App\Models\LoanManualApprover;
use App\Models\LoanNotification;
use App\Models\LoanPackage;
use App\Models\LoanProduct;
use App\Models\Loans;
use App\Models\LoanStatus;
use App\Models\LoanType;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;

trait LoanTrait{
    use EmailTrait;
    public $application;

    public function total_loans(){
        return Application::where('status', 1)->count();
    }
    public function total_open_loans_amount(){
        return Application::where('status', 1)->sum('amount');
    }
    public function total_closed_loans(){
        return Application::where('closed', 1)->count();
    }
    public function total_closed_loan_amount(){
        return Application::where('closed', 1)->sum('amount');
    }
    public function total_pending_loans(){
        return Application::where('status', 0)->count();
    }

    public function total_pending_loans_amount(){
        return Application::where('status', 0)->sum('amount');
    }

    public function num_of_repayments(){
        return Transaction::count();
    }

    public function total_repayment_amount(){
        return Transaction::sum('amount_settled');
    }
    public function total_loans_arears(){
        return Application::where('due_date', '<', now()) // Loans past due date
                         ->where('status', 1) // Status is open
                         ->sum('amount');
    }
    public function num_loans_arears(){
        return Application::where('due_date', '<', now()) // Loans past due date
                         ->where('status', 1) // Status is open
                         ->count();
    }

    public function total_disbursed_to_date(){
        return Application::where('status', 1) // Status is open
                         ->sum('amount');
    }
    public function num_disbursed_to_date(){
        return Application::where('status', 1) // Status is open
                         ->count();
    }

    public function total_unresolved_to_date(){
        return Application::where('status', 2)->sum('amount');
    }
    public function num_unresolved_to_date(){
        return Application::where('status', 2)->count();
    }

    public function total_rejected_to_date(){
        return Application::where('status', 3)->sum('amount');
    }
    public function num_rejected_to_date(){
        return Application::where('status', 3)->count();
    }

    public function num_assigned_staff(){
        return User::whereHas('assigned_loans')->count();
    }

    public function num_unassigned_staff() {
        return User::whereDoesntHave('assigned_loans')->count() - 1;
    }


    public function total_loan_officers(){
        return User::whereDoesntHave('roles', function($query) {
            $query->where('name', 'user');
        })->count() - 1;
    }

    public function closed_loans(){
        return $this->loan_requests = Loans::with('application')->where('closed', 1 )
        ->orderBy('id', 'desc')->get();
    }

    public function get_all_loan_types(){
        return LoanType::with('loan_child_type.loan_products')->get();
    }

    public function get_all_loan_child_types(){
        return LoanChildType::get();
    }

    public function get_all_loan_products(){
        return LoanProduct::with([
            'disbursed_by.disbursed_by',
            'interest_methods.interest_method',
            'interest_types.interest_type',
            // 'loan_accounts.account_payment',
            // 'loan_status.status',
            // 'loan_decimal_places',
            'service_fees.service_charge',
            'loan_institutes.institutions'
            ])->where('status', 1)->get();
    }

    public function get_loan_type($id){
        return LoanType::where('id', $id)->first();
    }

    public function get_loan_category($id){
        return LoanChildType::where('id', $id)->first();
    }

    public function get_loan_product($id){
        return LoanProduct::where('id', $id)->with([
            'disbursed_by.disbursed_by',
            'interest_methods.interest_method',
            'interest_types.interest_type',
            'loan_accounts.account_payment',
            'loan_status.status',
            'loan_decimal_places',
            'service_fees.service_charge',
            'loan_institutes.institutions',
            'repayment_cycle.repayment_cycle',
            'loan_child_type',

        ])->first();
    }

    public function get_loan_statuses($id){
        return LoanStatus::with('status')->where('loan_product_id', $id)
                        ->get();
    }
    public function get_loan_current_stage($id){
        return LoanStatus::with('status')->where('loan_product_id', $id)
                        ->first();
    }

    public function get_loan_expenses($id){
        return LoanExpense::where('application_id', $id)->get();
    }

    public function getAllLoanRequests($type){
        $userId = auth()->user()->id;

        if(auth()->user()->hasRole('admin')){
            // dd('here');
            return Application::with('loan_product')->whereNotNull('user_id')->get();
        }else{
            switch ($type) {
                case 'spooling':
                    return Application::with('loan_product')->whereNotNull('user_id')->get();
                    break;

                case 'manual':
                    return Application::with('loan_product')->whereNotNull('user_id')->with(['manual_approvers' => function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                        $query->where('is_active', 1);
                    }])->whereHas('manual_approvers', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                        $query->where('is_active', 1);
                    })
                    ->get();
                    break;

                case 'auto':
                    # code...
                    break;

                default:
                    # code...
                break;
            }
        }
    }

    public function getLoanRequests($type, $perPage = 10)
    {
        $userId = auth()->user()->id;

        if(auth()->user()->hasRole('admin')){
            // Admins get paginated results
            return Application::orWhere('status', 0)
                              ->orWhere('status', 2)
                              ->with('loan_product')
                              ->whereNotNull('user_id')
                              ->orderByDesc('id')
                              ->paginate($perPage);
        } else {
            switch ($type) {
                case 'spooling':
                    // Paginated results for spooling
                    return Application::orWhere('status', 0)
                                      ->orWhere('status', 2)
                                      ->with('loan_product')
                                      ->whereNotNull('user_id')
                                      ->orderByDesc('id')
                                      ->paginate($perPage);

                case 'manual':
                    // Paginated results for manual approvals
                    return Application::with('loan_product')
                                      ->with(['manual_approvers' => function ($query) use ($userId) {
                                          $query->where('user_id', $userId)
                                                ->where('is_active', 1);
                                      }])
                                      ->whereHas('manual_approvers', function ($query) use ($userId) {
                                          $query->where('user_id', $userId)
                                                ->where('is_active', 1);
                                      })
                                      ->orWhere('status', 2)
                                      ->orWhere('status', 0)
                                      ->whereNotNull('user_id')
                                      ->orderByDesc('id')
                                      ->paginate($perPage);

                case 'auto':
                    // Example pagination for 'auto' case (You'll need to define the actual conditions)
                    return Application::where('some_auto_condition', true)
                                      ->with('loan_product')
                                      ->whereNotNull('user_id')
                                      ->orderByDesc('id')
                                      ->paginate($perPage);

                default:
                    // Handle default case if needed or return empty paginated result
                    return Application::where('id', null) // No results by default
                                      ->paginate($perPage);
            }
        }
    }

    public function getOpenLoanRequests($type){
        $userId = auth()->user()->id;
        if(auth()->user()->hasRole('admin')){
            return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 0)->where('status', 1)
            ->orderBy('created_at', 'desc')->get();
        }else{
            switch ($type) {
                case 'spooling':
                    return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 0)
                    ->where('status', 1)
                    ->orderBy('created_at', 'desc')->get();
                    break;
                case 'manual':
                    return Application::with('loan_product')->whereNotNull('user_id')->with(['manual_approvers' => function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                        $query->where('is_active', 1);
                    }])->whereHas('manual_approvers', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                        $query->where('is_active', 1);
                    })
                    ->where('status', 1)
                    ->where('closed', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

                    break;
                case 'auto':
                    return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 0)->where('status', 1)
                    ->orderBy('created_at', 'desc')->get();

                    break;

                default:
                return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 0)->where('status', 1)
                ->orderBy('created_at', 'desc')->get();

                break;
            }
        }
    }

    public function getClosedLoanRequests($type){
        $userId = auth()->user()->id;
        if(auth()->user()->hasRole('admin')){
            return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 1)->where('status', 1)
    ->orderBy('created_at', 'desc')->get();
        }else{
            switch ($type) {
                case 'spooling':
                    return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 1)
                    ->where('status', 1)
    ->orderBy('created_at', 'desc')->get();
                    break;
                case 'manual':
                    return Application::with('loan_product')->whereNotNull('user_id')->with(['manual_approvers' => function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                        $query->where('is_active', 1);
                    }])->whereHas('manual_approvers', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                        $query->where('is_active', 1);
                    })
                    ->where('status', 1)
                    ->where('closed', 1)
    ->orderBy('created_at', 'desc')
                    ->get();

                    break;
                case 'auto':
                    return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 1)->where('status', 1)
    ->orderBy('created_at', 'desc')->get();
                    break;

                default:
                    return Application::with('loan_product')->whereNotNull('user_id')->where('closed', 1)->where('status', 1)
    ->orderBy('created_at', 'desc')->get();
                break;
            }
        }
    }
    public function getDueLoanRequests($type){

        $currentDate = Carbon::now();

        return Application::with('loan_product', 'loan')
            ->where('complete', 1)
            ->where('status', 1)
            ->where('due_date', '<', $currentDate)
            ->get();
        // $userId = auth()->user()->id;
        // if(auth()->user()->hasRole('admin')){
        //     return Application::with('loan_product')->where('complete', 1)->where('status', 1)->get();
        // }else{
        //     switch ($type) {
        //         case 'spooling':
        //             return Application::with('loan_product')->where('complete', 1)
        //             ->where('status', 1)->get();
        //             break;
        //         case 'manual':
        //             return Application::with('loan_product')->with(['manual_approvers' => function ($query) use ($userId) {
        //                 $query->where('user_id', $userId);
        //                 $query->where('is_active', 1);
        //             }])->whereHas('manual_approvers', function ($query) use ($userId) {
        //                 $query->where('user_id', $userId);
        //                 $query->where('is_active', 1);
        //             })
        //             ->where('status', 1)
        //             ->where('complete', 1)
        //             ->get();

        //             break;
        //         case 'auto':
        //             # code...
        //             break;

        //         default:
        //             # code...
        //         break;
        //     }
        // }
    }

    public function getLoanArears($type) {
        return Application::where('due_date', '<', now()) // Loans past due date
                         ->where('status', 1) // Status is active (or whatever status 1 means)
                         ->get();
    }


    public function getNoRepaymentLoan($type){
        return Application::with('loan_product', 'loan')
        ->where('complete', 1)
        ->where('status', 1)
        ->whereDoesntHave('loan_installments') // Check if the application doesn't have any associated loans
        ->get();

    }
    public function getPrincipalOutstandingLoan($type){
        return Application::with('loan_product', 'loan')
        ->where('complete', 1)
        ->where('status', 1)
        ->whereDoesntHave('loan_installments') // Check if the application doesn't have any associated loans
        ->get();

    }
    public function getOneMonthLate($type){
        return Application::with('loan_product', 'loan')
        ->where('complete', 1)
        ->where('status', 1)
        ->whereDoesntHave('loan_installments') // Check if the application doesn't have any associated loans
        ->get();
    }
    public function getThreeMonthLate($type){
        return Application::with('loan_product', 'loan')
        ->where('complete', 1)
        ->where('status', 1)
        ->whereDoesntHave('loan_installments') // Check if the application doesn't have any associated loans
        ->get();
    }

    public function getLoanPackages(){
        return LoanPackage::orderBy('created_at', 'desc')->get();
    }

    public function removeLoanPackage($id){
        $package = LoanPackage::find($id);
        if ($package) {
            $package->delete();
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentLoan(){
        return Application::with('loan')
        ->where('email', auth()->user()->email)
        ->orWhere('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc') // Add this line to order by 'created_at' column in descending order
        ->first();
    }

    public function get_loan_details($id){
        return Application::with('user.nextkin')
        ->with('user.uploads')
        ->where('id', $id)->first();
    }

    public function get_loan_qualification_ai($id) {
        // Fetch data with related user information
        $data = Application::with('user.nextkin')
            ->with('user.uploads')
            ->where('id', $id)
            ->first();

        // Convert the data to JSON
        $jsonData = json_encode($data);

        // URL of the Python endpoint
        $pythonEndpoint = 'https://001b-45-215-255-149.ngrok-free.app/process-pdf';

        // Initialize cURL session
        $ch = curl_init($pythonEndpoint);

        // Set the POST request options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Execute the request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            $error_message = curl_error($ch);
            // Handle error (log it, return an error response, etc.)
            curl_close($ch);
            return response()->json(['error' => 'Failed to communicate with the AI service: ' . $error_message], 500);
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $response_data = json_decode($response, true);

        // Check if the response is valid and contains the expected data
        if (isset($response_data['result'])) {
            // Return the result or process it further
            return [
                'message' => 'Documents have been successfully submitted and verified for assessment',
                'result' => $response_data['result']
            ];
        } else {
            // Handle unexpected response format
            return [
                'message' => 'Documents have not been completely submitted or assessed for verification.',
                'result' => []
            ];
        }
    }

    public function apply_loan($data)
    {
        try {
            $existingApplications = Application::where('status', 0)
                ->where('complete', 0)
                ->where('user_id', $data['user_id'])
                ->orderBy('created_at', 'desc')
                ->get();

            if ($existingApplications->isEmpty()) {
                $application = Application::create($data);
                if ($data['email']) {
                    $mail = [
                        'name' => "{$data['fname']} {$data['lname']}",
                        'to' => $data['email'],
                        'from' => 'admin@capexfinancialservices.org',
                        'phone' => $data['phone'],
                        'payback' => Application::payback($data['amount'], $data['repayment_plan']),
                        'subject' => "{$data['type']} Loan Application",
                        'message' => "Thank you for choosing us. Your loan request is submitted. Sign in with username {$data['email']} and password is 'capex+you' to check the status. We value your trust and are committed to your satisfaction.",
                        'message2' => "Capex Finance"
                    ];
                    // Mail::to($data['email'])->send(new LoanApplication($mail));
                }

                // dd(!empty($data['skip_to']));
                if(!empty($data['skip_to'])){
                    $status = Status::where('id', $data['skip_to'])->first();
                    ApplicationStage::create([
                        'application_id' => $application->id,
                        'loan_status_id' => $status->id,
                        'state' => 'current',
                        'status' => $status->name ?? 'verification', // Using the status retrieved from the query
                        'stage' => $status->stage ?? 'processing',
                        'prev_status' => 'current',
                        'curr_status' => '',
                        'position' => 1
                    ]);
                }else{
                    $status = DB::table('loan_statuses')
                    ->join('statuses', 'loan_statuses.status_id', '=', 'statuses.id')
                    ->select('loan_statuses.*', 'statuses.stage')
                    ->where('loan_statuses.loan_product_id', $data['loan_product_id'])
                    ->orderBy('loan_statuses.id', 'asc')
                    ->first();
                    ApplicationStage::create([
                        'application_id' => $application->id,
                        'loan_status_id' => 1,
                        'state' => 'current',
                        'status' => $status->stage ?? 'verification', // Using the status retrieved from the query
                        'stage' => 'processing',
                        'prev_status' => 'current',
                        'curr_status' => '',
                        'position' => 1
                    ]);
                }
                return $application->id;
            }
            return 'exists';
        } catch (\Throwable $th) {
            report($th);
            // return 'error';
        }
    }


    public function apply_update_loan($data, $loan_id){
            try {
                // check if user already created a loan application that is not approved yet and not complete
                $check = Application::where('id', $loan_id)->first();
                $check->update($data);

            } catch (\Throwable $th) {
                return 0;
            }
    }

    public function updateGuarantors($data){
        $application = Application::where('id', $data['application_id'])->first();
        $application->update($data);
    }


    public function remake_loan($loan_id, $new_due_date){
        $x = Application::where('id', $loan_id)->first();
        Loans::where('application_id', '=', $loan_id)->delete();
        $this->make_loan($x, $new_due_date);
    }

    public function make_loan($x, $due_date){
        try {
            if($due_date !== null){
                $due = $due_date.' 00:00:00';
            }else{
                $due = Carbon::now()->addMonth($x->repayment_plan);
            }
            $loan = Loans::create([
                'application_id' => $x->id,
                'repaid' => 0,
                'principal' => $x->amount ?? 0,
                'payback' => $x->amount * 0.2,
                'penalty' => 0,
                'interest' => $x->interest ?? 20,
                'final_due_date' => $due,
                'closed' => 0
            ]);

            $payback_amount = Application::payback($x->amount, $x->repayment_plan);
            $installments = $payback_amount / $x->repayment_plan;

            for ($i=0; $i < $x->repayment_plan; $i++) {
                if($x->doa !== null){
                    $date_str = $x->doa;
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_str);
                    $moths = 'P'. $i+1 .'M';
                    $next_due = $date->add(new DateInterval($moths));

                }else{
                    $due = Carbon::now()->addMonth($x->repayment_plan);
                    $next_due = Carbon::now()->addMonth($i+1);
                }

                LoanInstallment::create([
                    'loan_id' => $loan->id,
                    'next_dates' => $next_due,
                    'amount' => $installments
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function notify_loan_request($data){

        $admin = User::where('id', $data['user_id']);
        try {
            Notification::send($admin, new LoanRequestNotification($data));
            return true;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function payback_ammount($amount, $duration){
        $interest_rate = 20 / 100;
        return $amount * (1 + ($interest_rate * (int)$duration));
    }

    public function missed_repayments(){
        if (auth()->user()->hasRole('user')) {
            return DB::table('applications')
                ->join('users', 'users.id', '=', 'applications.user_id')
                ->join('loans', 'applications.id', '=', 'loans.application_id')
                ->join('loan_installments', 'loans.id', '=', 'loan_installments.loan_id')
                ->where('applications.status', '=', 1)
                ->where('applications.complete', '=', 1)
                ->where('applications.user_id', '=', auth()->user()->id)
                ->where('loan_installments.next_dates', '<', now())
                ->whereNotNull('applications.type')
                ->select('loans.id','users.fname', 'users.lname', 'applications.*', 'loan_installments.next_dates')
                ->get();
        }else{
            return DB::table('applications')
                ->join('users', 'users.id', '=', 'applications.user_id')
                ->join('loans', 'applications.id', '=', 'loans.application_id')
                ->join('loan_installments', 'loans.id', '=', 'loan_installments.loan_id')
                ->where('applications.status', '=', 1)
                ->where('applications.complete', '=', 1)
                ->where('loan_installments.next_dates', '<', now())
                ->whereNotNull('applications.type')
                ->select('loans.id','users.fname', 'users.lname', 'applications.*', 'loan_installments.next_dates')
                ->get();
        }
    }
    public function past_maturity_date(){
        if (auth()->user()->hasRole('user')) {
            return Application::with(['loan' => function ($query) {
                $query->where('final_due_date', '<', now());
            }])->with('user')
            ->where('user_id', auth()->user()->id)
            ->where('status', 1)->where('complete', 1)->get();
        }else{
            return Application::with(['loan' => function ($query) {
                $query->where('final_due_date', '<', now());
            }])->with('user')->where('status', 1)->where('complete', 1)->get();
        }

    }


    // -------- Approvals
    public function final_approver($application_id)
    {
        $approvers = LoanManualApprover::where('application_id', $application_id)->get();
        $userPriority = $approvers->where('user_id', auth()->user()->id)->pluck('priority')->first();
        $is_passed = $approvers->where('user_id', auth()->user()->id)->pluck('is_passed')->first();
        // If false then there are still more approvers | must be dynamic
        if ((int)$approvers->count() >= (int)$userPriority) {
            return [
                'status' => true,
                'priority' => $userPriority,
                'total_approvers' => $approvers->count(),
                'is_passed' =>$is_passed
            ];
        } else {
            return [
                'status' => false,
                'priority' => $userPriority,
                'total_approvers' => $approvers->count(),
                'is_passed' => $is_passed
            ];
        }
    }

    public function my_approval_status($application_id){
        return LoanManualApprover::where('user_id', auth()->user()->id)
                        ->where('application_id', $application_id)
                        ->pluck('is_passed')->first();
    }

    public function my_review_status($application_id){
        return LoanManualApprover::where('user_id', auth()->user()->id)
                        ->where('application_id', $application_id)
                        ->pluck('is_processing')->first();
    }

    public function upvote($application_id){
        $approvers = LoanManualApprover::where('application_id', $application_id)->get();
        $userPriority = $approvers->where('user_id', auth()->user()->id)->pluck('priority')->first();

        // Leave current approver
        $update = $approvers->where('priority', $userPriority)->first();
        // dd($update);
        $update->complete = 1; //optional - remove
        $update->is_passed = 1;
        $update->is_active = 0;
        $update->is_processing = 0;
        $update->save();

        // Elevate to the next priority
        $update = $approvers->where('priority', $userPriority + 1)->first();
        if($update){

            $update->complete = 1; //optional - remove
            $update->is_active = 1;
            $update->is_processing = 1;
            $update->save();
        }
    }
    public function final_upvote($application_id){

        // dd($application_id);
        $approvers = LoanManualApprover::where('application_id', $application_id)->get();
        $userPriority = $approvers->where('user_id', auth()->user()->id)->pluck('priority')->first();

        // dd($userPriority);
        // Leave current approver
        $update = $approvers->where('priority', $userPriority)->first();
        // dd($update);
        $update->is_passed = 1;
        $update->is_active = 0;
        $update->is_processing = 0;
        $update->save();

        // Elevate to the next priority
        $update = $approvers->where('priority', $userPriority + 1)->first();
        $update->is_active = 1;
        $update->is_processing = 1;
        $update->save();
    }

    public function loan_notifications($id){
        return LoanNotification::where('application_id', $id)->get();
    }

}
