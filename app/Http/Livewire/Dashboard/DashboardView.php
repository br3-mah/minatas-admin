<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Application;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawRequest;
use App\Traits\EmailTrait;
use App\Traits\LoanTrait;
use App\Traits\UserTrait;
use App\Traits\WalletTrait;
use Livewire\Component;
use Illuminate\Support\Str;

class DashboardView extends Component
{
    use EmailTrait, WalletTrait, LoanTrait, UserTrait;
    public $loan_requests, $loan_request, $all_loan_requests, $my_loan, $wallet, $borrowers;
    public $payment_method, $withdraw_amount, $mobile_number, $card_name, $bank_name, $card_number;
    public $performingData = [], $nonPerformingData = [];
    public $closedLoansCount, $rejectedLoansCount, $pendingLoansCount, $loansCount, $unresolvedLoansAmount;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->performingData = Application::where('status', 1)->whereHas('transactions')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $this->nonPerformingData = Application::where('status', 1)->doesntHave('transactions')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $this->closedLoansCount = $this->total_closed_loans();
        $this->rejectedLoansCount = $this->num_rejected_to_date();
        $this->pendingLoansCount = $this->total_pending_loans();
        $this->loansCount = $this->total_loans();
        $this->unresolvedLoansAmount = $this->num_unresolved_to_date();
    }

    public function render()
    {
        $user = auth()->user();
        $this->borrowers = User::role('user')->orderBy('created_at', 'desc')->get();
        $this->wallet = $this->getWalletBalance($user);
        if ($user->hasRole('user')) {
            return view('livewire.dashboard.not-admin-view')->layout('layouts.bouncer');
        } else {
            $this->all_loan_requests = Application::orWhere('status', 0)->orWhere('status', 2)
                ->orderBy('created_at', 'desc')->take(7)->get();

            $chartData = $this->prepareChartData();

            return view('livewire.dashboard.dashboard-view', [
                'performingData' => $this->performingData ?? [0,0,0,0,0],
                'nonPerformingData' => $this->nonPerformingData ?? [0,0,0,0,0],
                'chartData' => $chartData,
                'closedLoansCount' => $this->closedLoansCount,
                'rejectedLoansCount' => $this->rejectedLoansCount,
                'pendingLoansCount' => $this->pendingLoansCount,
                'loansCount' => $this->loansCount,
                'unresolvedLoansAmount' => $this->unresolvedLoansAmount,
            ])->layout('layouts.main');
        }
    }

    private function prepareChartData()
    {
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $performing = [];
        $nonPerforming = [];

        foreach ($months as $month) {
            $performing[] = $this->performingData[$month] ?? 0;
            $nonPerforming[] = $this->nonPerformingData[$month] ?? 0;
        }

        return [
            'performing' => $performing,
            'nonPerforming' => $nonPerforming,
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    public function submitWithdrawRequest(){
        $uuid = Str::orderedUuid();
        WithdrawRequest::create([
            'wallet_id' => Wallet::where('user_id', auth()->user()->id)->first()->id,
            'amount' => $this->withdraw_amount,
            'ref' => substr($uuid, 0, 6),
            'withdraw_method' => $this->payment_method,
            'mobile_number' => $this->mobile_number,
            'card_name' => $this->card_name,
            'bank_name' => $this->bank_name,
            'comments' => 'You have received a new wallet withdraw request',
            'card_number' => $this->card_number,
            'user_id' => auth()->user()->id
        ]);
        session()->flash('success', 'Your withdraw request has been sent');
    }

    public function approve($id){
        try {
            $x = Application::find($id);
            $x->status = 1;
            $x->save();
            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been successfully accepted'
            ];
            $this->send_loan_feedback_email($mail);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function stall($id){
        // set under review
        try {
            $x = Application::find($id);
            $x->status = 2;
            $x->save();

            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application is under review'
            ];
            $this->send_loan_feedback_email($mail);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function reject($id){
        try {
            $x = Application::find($id);
            $x->status = 3;
            $x->save();

            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been rejected'
            ];
            $this->send_loan_feedback_email($mail);

        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
