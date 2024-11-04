<?php

namespace App\Http\Livewire;

use App\Models\Graduate;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class CrudGraduatet extends Component
{
    public $isOpen = false;
    public $search, $graduate;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'graduate.code' => 'required',
        'graduate.specialty' => 'required',
        'graduate.academic_level' => 'required',
        'graduate.user_id' => 'required',
    ];

    public function render()
    {
        $graduates = Graduate::where('code', 'LIKE', '%' . $this->search . '%')
            ->orWhere('specialty', 'LIKE', '%' . $this->search . '%')
            ->orWhere('academic_level', 'LIKE', '%' . $this->search . '%')
            ->orWhere('user_id', 'LIKE', '%' . $this->search . '%')
            ->paginate(7);
        
        // Solo mostramos el usuario autenticado
        $users = [auth()->user()];

        return view('docente.crud-graduatet', compact('graduates', 'users'));
    }

    public function create()
    {
        $this->isOpen = true;
    }

    public function store()
    {
        // Validamos los datos
        $this->validate();

        // Asignamos el ID del usuario autenticado antes de guardar
        $this->graduate['user_id'] = auth()->user()->id;

        // Guardamos el registro
        if (!isset($this->graduate['id'])) {
            Graduate::create($this->graduate);
        } else {
            Graduate::updateOrCreate(['id' => $this->graduate['id']], $this->graduate);
        }

        // Reseteamos el formulario y cerramos el modal
        $this->reset(['isOpen', 'graduate']);
        $this->emitTo('CrudGraduate', 'render');
    }

    public function delete(Graduate $item)
    {
        $item->delete();
    }

    public function edit($graduate)
    {
        $this->graduate = $graduate;
        $this->isOpen = true;
    }

    public function updatedGraduateName()
    {
        $this->graduate['specialty'] = Str::slug($this->graduate['code']);
    }

    public $doctorCount;
    public $maestroCount;
    public $bachillerCount;

    public function mount()
    {
        $this->graduateCount = Graduate::count();
        $this->academicLevels = Graduate::groupBy('academic_level')
            ->select('academic_level', \DB::raw('COUNT(*) as count'))
            ->pluck('count', 'academic_level');
    }
}
