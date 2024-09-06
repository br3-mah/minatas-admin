<?php

namespace App\Http\Livewire\Dashboard\Settings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UserUpdateView extends Component
{
    use AuthorizesRequests;
    public $user;
    public $user_role, $roles, $permissions, $current_role_name;
    
    public function mount($id)
    {
        $this->user_role = Role::pluck('name')->toArray();
        $this->permissions = Permission::get();
        $this->roles = Role::all();
        $this->user = User::find($id);
        $this->current_role_name = $this->user->roles->first()->name ?? null;
    }

    public function render()
    {
        return view('livewire.dashboard.settings.user-update-view')
        ->layout('layouts.main');
    }
}
