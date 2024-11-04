<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Graduate;
use App\Models\Joboffer;
use App\Models\Postulation;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobofferLivewire extends Component
{
    use WithFileUploads;

    public function render()
    {
        $joboffers = Joboffer::latest()->paginate(9);
        $categories = Category::all();
        $graduates = Graduate::all();
        return view('joboffer.joboffer-livewire', compact('joboffers', 'categories', 'graduates'));
    }

    public $isOpen = false;
    public $ruteCreate = false;
    public $cv;

    public $search, $postulation;

    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'cv' => 'required', // Cambiado a 'cv' en lugar de 'postulation.cv'
    ];



    public function selectJobOffer($jobofferId)
    {
        $this->selectedJobOffer = Joboffer::find($jobofferId);
        $this->isOpen = true;
    }


    public function create()
    {
        $this->isOpen = true;
        $this->ruteCreate = true;
        $this->reset(['postulation', 'cv']); // Resetea el campo del CV
    }

    public function store()
    {
        $this->validate([
            'cv' => 'required', // Valida que el CV esté cargado
        ]);

        // Obtener el graduado que ha iniciado sesión
        $graduate = Auth::user()->graduate;

        if ($graduate) {
            $graduateId = $graduate->id;

            // Asegúrate de que $this->selectedJobOffer está definido
            if (isset($this->selectedJobOffer)) {
                $jobofferId = $this->selectedJobOffer->id;  // Asegúrate de que este ID se obtiene correctamente
            } else {
                // Si no está definido, depura
                dd("No se ha seleccionado ninguna oferta de trabajo.");
            }

            // Verificar si ya existe una postulación para este graduado y esta oferta de trabajo
            $existingPostulation = Postulation::where('graduate_id', $graduateId)
                                               ->where('joboffer_id', $jobofferId)
                                               ->first();

            if ($existingPostulation) {
                // Si ya existe una postulación, puedes retornar un mensaje de error o redirigir
                session()->flash('error', 'Ya te has postulado a esta oferta de trabajo.');
                return;
            }

            // Crear una nueva postulación
            $postulation = Postulation::create([
                'cv' => $this->cv->store('public/cv'), // Guarda el archivo del CV
                'graduate_id' => $graduateId,          // ID del graduado que postula
                'joboffer_id' => $jobofferId,          // ID de la oferta de trabajo
            ]);

            // Limpiar el formulario y cerrar el modal
            $this->reset(['isOpen', 'postulation', 'cv']);
            $this->emitTo('CrudPostulation', 'render');

            // Redirigir a la página de detalles del trabajo después de postular
            return redirect()->route('joboffers.show', $jobofferId);
        } else {
            // Manejar caso donde el graduado no existe
            return redirect()->route('home')->with('error', 'Graduado no encontrado.');
        }
    }


    // Método para obtener el ID del joboffer basado en la descripción (ajusta según tu lógica)
    public function delete(Postulation $item)
    {
        $item->delete();
    }

    public function edit($postulation)
    {
        $this->postulation = $postulation;
        //dd($this->postulation);
        $this->isOpen = true;
    }

    public function canApply($jobofferId)
    {
        $userId = Auth::id();

        // Cambiar 'JobApplication' por 'Postulation' o el modelo correcto
        $hasApplied = Postulation::where('joboffer_id', $jobofferId)
                                  ->where('graduate_id', $userId)  // Cambia 'graduate_id' si es necesario
                                  ->exists();

        return !$hasApplied;
    }



}
