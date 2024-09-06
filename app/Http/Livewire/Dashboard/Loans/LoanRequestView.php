<?php

namespace App\Http\Livewire\Dashboard\Loans;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Maatwebsite\Excel\Facades\Excel;
use App\Classes\Exports\LoanExport;
use App\Models\Application;
use App\Models\LoanManualApprover;
use App\Models\User;
use App\Traits\EmailTrait;
use App\Traits\WalletTrait;
use App\Traits\LoanTrait;
use App\Traits\SettingTrait;
use App\Traits\UserTrait;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LoanRequestView extends Component
{
    use EmailTrait, WalletTrait, LoanTrait, SettingTrait, UserTrait, AuthorizesRequests;
    public $loan_request, $new_loan_user, $user_basic_pay, $user_net_pay, $loan_id;
    public $status = [];
    public $view = 'list';
    public $users, $due_date;
    public $assignModal = false;
    public $title = 'Recent Loan Requests';
    
    public function render()
    {

        $this->authorize('view loans');
        // Retrieve users with the 'user' role, excluding their applications
        $this->users = User::role('user')->without('applications')->get();

        if($this->current_configs('loan-approval')->value == 'auto'){
            // get loan only if first review as approved
            $requests = $this->getLoanRequests('auto');
        }elseif($this->current_configs('loan-approval')->value == 'manual'){
            $requests = $this->getLoanRequests('manual');
        }else{
            $requests = $this->getLoanRequests('spooling');
        }
        // dd($requests);
        return view('livewire.dashboard.loans.loan-request-view',[
            'requests'=>$requests
        ])->layout('layouts.main');

    }

    public function reviewLoan()
    {

        Application::where('id', $this->loan_id)->update(['status' => 2]);
        LoanManualApprover::where('user_id', auth()->id())->update(['is_processing' => 1]);
        // Redirect to other page here
        Redirect::route('loan-details',['id' => $this->loan_id]);
        session()->flash('success', 'Loan successfully set under review!');
        sleep(3);

    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function clear(){
        $this->due_date = '';
    }

    public function destroy($id){
        Application::where('id', $id)->first()->delete();
        session()->flash('success', 'Deleted permanently');
    }
}
