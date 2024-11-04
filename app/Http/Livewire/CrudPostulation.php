<?php

namespace App\Http\Livewire;

use App\Models\Graduate;
use App\Models\Postulation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CrudPostulation extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $ruteCreate = false;
    public $search, $postulation, $cv, $selectedJobOffer;

    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'postulation.status' => 'required',
        'postulation.graduate_id' => 'required|exists:graduates,id',
        'postulation.joboffer_id' => 'required|exists:joboffers,id',
        'cv' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png', // Validación de archivo opcional
    ];

    public function render()
{
    $user = Auth::user(); // Obtener el usuario autenticado

    if ($user->role_id == 1) { // Si el usuario es un graduado
        // Mostrar solo las postulaciones realizadas por el graduado actual
        $postulations = Postulation::where('graduate_id', $user->graduate->id)
            ->where('cv', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);
    } elseif ($user->role_id == 2) { // Si el usuario es una empresa
        // Mostrar solo las postulaciones a las ofertas de trabajo de esta empresa
        $postulations = Postulation::whereHas('joboffer', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Suponiendo que 'user_id' en Joboffer indica el usuario que creó la oferta
            })
            ->where('cv', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);
    } else { // Si el usuario es un administrador
        // Mostrar todas las postulaciones
        $postulations = Postulation::where('cv', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);
    }

    // Obtener los graduados para el listado
    $graduates = Graduate::all();
    return view('postulationi.crud-postulation', compact('postulations', 'graduates'));
}




    public function create()
    {
        $this->reset(['postulation', 'cv']);
        $this->isOpen = true;
        $this->ruteCreate = true;
    }

    public function store()
    {
        $this->validate([
            'cv' => 'required|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png', // Asegura que el CV esté cargado
        ]);

        // Obtener el graduado que ha iniciado sesión
        $graduate = Auth::user()->graduate;

        if ($graduate) {
            $graduateId = $graduate->id;

            // Verificar si se seleccionó una oferta de trabajo
            if (isset($this->selectedJobOffer)) {
                $jobofferId = $this->selectedJobOffer->id;
            } else {
                dd("No se ha seleccionado ninguna oferta de trabajo.");
            }

            // Verificar si ya se ha postulado a esta oferta
            $existingPostulation = Postulation::where('graduate_id', $graduateId)
                                               ->where('joboffer_id', $jobofferId)
                                               ->first();

            if ($existingPostulation) {
                session()->flash('error', 'Ya te has postulado a esta oferta de trabajo.');
                return;
            }

            // Guardar el archivo del CV correctamente
            $cvPath = $this->cv->store('cv', 'public');  // Guarda el archivo en la carpeta 'public/cv'
            $cvFileName = basename($cvPath);  // Obtener solo el nombre del archivo

            // Crear la postulación en la base de datos
            Postulation::create([
                'cv' => $cvFileName, // Solo almacenar el nombre del archivo en la base de datos
                'graduate_id' => $graduateId,
                'joboffer_id' => $jobofferId,
                'status' => 'pending',  // Asigna el status como "pending" por defecto
            ]);

            // Limpiar el formulario y cerrar el modal
            $this->reset(['isOpen', 'postulation', 'cv']);
            $this->emitTo('CrudPostulation', 'render');
        }
    }

    public function updatePostulation()
    {
        $postulation = Postulation::findOrFail($this->postulation['id']);

        // Si hay un nuevo archivo, eliminar el anterior y guardar el nuevo
        if ($this->cv) {
            if ($postulation->cv) {
                Storage::disk('public')->delete('cv/' . $postulation->cv); // Eliminar el archivo anterior
            }
            $cvPath = $this->cv->store('cv', 'public');
            $this->postulation['cv'] = basename($cvPath); // Guardar solo el nombre del nuevo archivo
        }

        // Actualizar otros campos
        $postulation->status = $this->postulation['status'];
        $postulation->graduate_id = $this->postulation['graduate_id'];
        $postulation->joboffer_id = $this->postulation['joboffer_id'];
        $postulation->save();
    }

    public function confirmDeletion($id)
    {
        if (confirm('¿Estás seguro de que deseas eliminar esta postulación?')) {
            $this->emit('deleteItem', $id);
        }
    }

    public function delete($id)
    {
        $postulation = Postulation::findOrFail($id);

        // Eliminar el archivo asociado si existe
        if ($postulation->cv) {
            Storage::disk('public')->delete('cv/' . $postulation->cv);
        }

        $postulation->delete();

        // Emitir el evento para recargar la tabla de postulaciones
        $this->emitTo('CrudPostulation', 'render');
    }

    public function edit($id)
    {
        $this->postulation = Postulation::findOrFail($id);
        $this->isOpen = true;
        $this->ruteCreate = false;
    }

    public function update()
{
    // Validación de los campos de la postulación
    $this->validate([
        'postulation.status' => 'required',
        'postulation.graduate_id' => 'required|exists:graduates,id',
        'postulation.joboffer_id' => 'required|exists:joboffers,id',
        'cv' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
    ]);

    // Buscar la postulación que se va a actualizar
    $postulation = Postulation::findOrFail($this->postulation['id']);

    // Si hay un nuevo archivo de CV, guardarlo
    if ($this->cv) {
        if ($postulation->cv) {
            Storage::disk('public')->delete('cv/' . $postulation->cv); // Eliminar el archivo anterior
        }
        $cvPath = $this->cv->store('cv', 'public');
        $postulation->cv = basename($cvPath); // Guardar solo el nombre del nuevo archivo
    }

    // Actualizar los demás campos de la postulación
    $postulation->status = $this->postulation['status'];
    $postulation->graduate_id = $this->postulation['graduate_id'];
    $postulation->joboffer_id = $this->postulation['joboffer_id'];
    $postulation->save();

    // Limpiar los campos del formulario y cerrar el modal
    $this->reset(['isOpen', 'postulation', 'cv']);
    $this->emitTo('CrudPostulation', 'render');

    // Mensaje de éxito
    session()->flash('message', 'Postulación actualizada con éxito.');
}

}
