<?php

namespace App\Http\Livewire;

use App\Models\Graduate;
use App\Models\User;
use App\Models\Institution;
use Livewire\Component;

class CrudGraduate extends Component
{
    public $isOpen = false;
    public $search = '';
    public $graduate = [];
    
    protected $listeners = ['render', 'delete' => 'delete'];

    // Eliminamos la validación de `required` para `graduate.user_id`
    protected $rules = [
        'graduate.code' => 'required',
        'graduate.specialty' => 'required',
        'graduate.academic_level' => 'required',
        'graduate.institution_id' => 'required|exists:institutions,id',
    ];

    public function messages()
    {
        return [
            'graduate.code.required' => 'Ingresa el código',
            'graduate.specialty.required' => 'Seleccione la especialidad del egresado',
            'graduate.academic_level.required' => 'Seleccione el nivel académico del egresado',
            'graduate.institution_id.required' => 'Seleccione la institución',
        ];
    }

    public function render()
    {
        $graduates = Graduate::where('code', 'LIKE', '%' . $this->search . '%')
                             ->orWhere('specialty', 'LIKE', '%' . $this->search . '%')
                             ->orWhere('academic_level', 'LIKE', '%' . $this->search . '%')
                             ->latest('id')
                             ->paginate(6);

        $users = User::all();
        $institutions = Institution::all();

        return view('institucion.crud-graduate', compact('graduates', 'users', 'institutions'));
    }

    public function create()
    {
        // Abrimos el modal y reseteamos el formulario
        $this->reset(['graduate']);
        $this->resetValidation(); // Reseteamos las validaciones anteriores
        $this->isOpen = true;
    }

    public function store()
    {
        // Validamos los datos antes de guardar
        $this->validate();

        // Asignamos el ID del usuario autenticado automáticamente
        $this->graduate['user_id'] = auth()->user()->id;

        // Usamos `updateOrCreate` para manejar la creación y actualización
        Graduate::updateOrCreate(
            ['id' => $this->graduate['id'] ?? null], // Si existe un ID, actualiza; si no, crea uno nuevo
            $this->graduate
        );

        // Reseteamos el formulario y cerramos el modal
        $this->reset(['isOpen', 'graduate']);
        $this->emitTo('CrudGraduate', 'render');
        $this->emit('alert', 'Registro creado satisfactoriamente');
    }

    public function delete($id)
    {
        Graduate::find($id)->delete();
        $this->emit('alert', 'Registro eliminado correctamente');
    }

    public function edit(Graduate $graduate)
    {
        // Convertimos el modelo a un array para asignarlo al formulario
        $this->graduate = $graduate->toArray();
        $this->isOpen = true;
    }
}
