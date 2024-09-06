<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Classes\Exports\GuarantorExport;
use App\Models\Application;
use App\Models\Guarantor;
use App\Models\NextOfKing;
use App\Models\References;
use Livewire\Component;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class GuarantorsView extends Component
{
    public $guarantors;

    public function render()
    {
        $this->guarantors = Guarantor::get();
        return view('livewire.dashboard.loans.guarantors-view')->layout('layouts.main');
    }
    public function exportGuarantors(){
        return Excel::download(new GuarantorExport, 'Guarantors.xlsx');
    }
}
