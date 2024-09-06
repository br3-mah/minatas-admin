<?php

namespace App\Http\Livewire\Dashboard\Borrowers;

use App\Models\User;
use Livewire\Component;

class TranscriptView extends Component
{

// On our platform, our we able to download the information on historical data on our customers showing
// (i)	when each customer signed up; and
// (ii)	their loan activity since then (amount borrowed, date borrowed, repayments and any repeat borrowing owing to a server migration this weekend.


    public $data, $key;

    public function mount(){
        $this->key = $_GET['key'];
    }

    public function render()
    {
        $this->data = $this->searchAccount($this->key);
        return view('livewire.dashboard.borrowers.transcript-view')
        ->layout('layouts.main');
    }

    public function searchAccount($key){
        return User::where('id', $key)
              ->orWhere('fname', $key)
              ->orWhere('lname', $key)
              ->orWhere('email', $key)
              ->orWhere('nrc', $key)->with('loans')->with('wallet')->with('blacklist')->get()->first();
    }
}
