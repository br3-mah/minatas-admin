<?php

namespace App\Http\Livewire\Dashboard\Accounts;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\BlackList;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Livewire\Component;
use App\Classes\Exports\AccountDetailExportExport;

class AccountView extends Component
{
    public $user, $key;
    public function mount(){
        $this->key = $_GET['key'];
    }
    public function render()
    {
        $this->user = $this->searchAccount($this->key);
        if ($this->user->hasRole('user')) {
            return view('livewire.dashboard.accounts.account-view')
            ->layout('layouts.admin');
        }else{
            return view('livewire.dashboard.accounts.employee-account-view')
            ->layout('layouts.admin');
        }
    }

    public function searchAccount($key){
        return User::where('id', $key)
              ->orWhere('fname', $key)
              ->orWhere('lname', $key)
              ->orWhere('email', $key)
              ->orWhere('nrc', $key)->with('loans')->with('wallet')->with('blacklist')->get()->first();
    }

    // public function exportPDF(){
    //     return Excel::download(new AccountDetailExportExport, 'invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    // }

    public function blockUser(){
        try {
            BlackList::create([
                'user_id' => $this->data->id,
                'email' => $this->data->email,
                'comments' => 'Blacklisted'
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function unblockUser(){
        BlackList::where('user_id', $this->data->id)->first()->delete();
    }
}
