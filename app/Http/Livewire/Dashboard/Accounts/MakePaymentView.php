<?php

namespace App\Http\Livewire\Dashboard\Accounts;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Classes\Exports\TransactionExport;
use App\Models\Application;
use App\Models\LoanInstallment;
use App\Models\Loans;
use App\Models\Transaction;
use App\Traits\WalletTrait;
use App\Traits\LoanTrait;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class MakePaymentView extends Component
{
    use AuthorizesRequests, WalletTrait, LoanTrait;
    public $amount, $loan_id, $loans, $transactions, $payment_method;

    public function render()
    {
        $this->authorize('view accounting');
        $this->loans = $this->getOpenLoanRequests('auto');
        $this->transactions = Transaction::with('application.user')->orderBy('created_at', 'desc')->get();
        return view('livewire.dashboard.accounts.make-payment-view')
        ->layout('layouts.main');
    }

    public function makepayment(){
        DB::beginTransaction();
        try {
            // Update Borrower Balance
            $borrower_loan = Application::where('id', $this->loan_id)->first();
            $balance = Loans::loan_balance($borrower_loan->id);
          
            if($this->amount <= $balance){
                // Insert in company wallet
                $this->repayLoanWalletFunds($this->amount);
                Transaction::create([
                    'application_id' => $borrower_loan->id,
                    'amount_settled' => $this->amount,
                    'transaction_fee' => 0,
                    'profit_margin' => 0,
                    'proccess_by' => auth()->user()->fname.' '.auth()->user()->lname,
                    'charge_amount' => 0,
                    'method' => $this->payment_method,
                    'user_id' => $borrower_loan->user_id,
                ]);

                // Update Installment
                // $installment = LoanInstallment::where('loan_id', $borrower_loan->id)->whereNull('paid_at')->first();
                // $installment->paid_at = Carbon::now();
                // $installment->save();

                // Close loan if the balance is 0
                if(Loans::loan_balance($borrower_loan->id) < 1){
                    $borrower_loan->closed = 1;
                    $borrower_loan->date_paid = Carbon::now();
                    $borrower_loan->save();
                }

                DB::commit();
                session()->flash('success', 'Successfully repaid '.$this->amount);
                return redirect()->route('make-payment');
            }else{
                session()->flash('error', 'The amount you enter is greater than the repayment amount. Failed Transaction');
                return redirect()->route('make-payment');
            }
        } catch (\Throwable $th) {
            // dd($th);
            session()->flash('error', 'Failed');
            return redirect()->route('make-payment');
        }
    }

    public function exportTransanctions(){
            return Excel::download(new TransactionExport, 'Transaction Log.xlsx');
    }
}
