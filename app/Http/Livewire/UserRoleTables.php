<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserRoleTables extends Component
{
    public $searchUser = '';
    public $searchCompany = '';
    public $confirmingUserDeletion = false;
    public $userToDelete = null;

    public function confirmUserDeletion($userId)
    {
        $this->userToDelete = $userId;
        $this->confirmingUserDeletion = true;
    }

    public function deleteUser()
    {
        User::findOrFail($this->userToDelete)->delete();
        $this->confirmingUserDeletion = false;
        $this->userToDelete = null;
        session()->flash('message', 'Usuario/Empresa eliminado exitosamente.');
    }

    public function render()
    {
        $users = User::where('role_id', '!=', 2)
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->searchUser . '%')
                      ->orWhere('email', 'like', '%' . $this->searchUser . '%');
            })->get();

        $companies = User::where('role_id', 2)
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->searchCompany . '%')
                      ->orWhere('email', 'like', '%' . $this->searchCompany . '%');
            })->get();

        return view('livewire.user-role-tables', compact('users', 'companies'));
    }
}
