<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Asegúrate de importar el modelo Role
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Mostrar usuarios pendientes
    public function pendingUsers()
    {
        $users = User::where('status', 0)->get();
        return view('livewire.pending-users', compact('users'));
    }

    // Aprobar usuario y asignar rol
    public function approveUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->input('role') === 'usuario') {
            $user->status = 1; // Aceptado como usuario
            $role = Role::where('name', 'usuario')->first(); // Obtener el rol 'usuario'
            $user->role_id = $role->id; // Asignar el rol al usuario
        } elseif ($request->input('role') === 'empresa') {
            $user->status = 2; // Aceptado como empresa
            $role = Role::where('name', 'empresa')->first(); // Obtener el rol 'empresa'
            $user->role_id = $role->id; // Asignar el rol al usuario
        }

        $user->save();

        return redirect()->back()->with('success', 'Usuario aprobado correctamente.');
    }
}
