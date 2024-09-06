<?php

namespace App\Http\Livewire\Dashboard\Borrowers;

use Livewire\Component;
use App\Models\NextOfKing;
use App\Models\References;
use App\Models\RelatedParty;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ReferencesView extends Component
{
    public $related_parties;

    public function render()
    {

        // $this->authorize('view loan relatives');
        $this->related_parties = RelatedParty::get();
        return view('livewire.dashboard.borrowers.references-view')->layout('layouts.main');
    }
}
