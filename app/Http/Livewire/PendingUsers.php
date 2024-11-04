<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Notifications\UsuarioAprobado;  // Asegúrate de incluir la notificación

class PendingUsers extends Component
{
    public $selectedRole = [];

    // Este método se ejecutará cuando hagas clic en "Aprobar"
    public function approve($userId)
    {
        // Validar que se haya seleccionado un rol para el usuario
        if (!isset($this->selectedRole[$userId])) {
            session()->flash('error', 'Por favor selecciona un rol antes de aprobar.');
            return;
        }

        // Encontrar el usuario por su ID
        $user = User::find($userId);

        if ($user) {
            // Asignar el rol seleccionado y actualizar el estado del usuario
            $user->role = $this->selectedRole[$userId];  // Asignar el rol seleccionado
            $user->status = 1;  // Suponiendo que '1' significa aprobado
            $user->save();

            // Enviar notificación por correo al usuario
            $user->notify(new UsuarioAprobado());

            session()->flash('message', 'Usuario aprobado exitosamente y notificación enviada.');
        } else {
            session()->flash('error', 'Usuario no encontrado.');
        }
    }

    public function render()
    {
        // Obtener los usuarios pendientes de aprobación (status 0)
        $users = User::where('status', 0)->get();

        return view('livewire.pending-users', ['users' => $users]);
    }
}
