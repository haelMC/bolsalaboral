<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Joboffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrudJoboffer extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $showPreviewModal = false;
    public $search;
    public $joboffer = [];
    public $image;
    public $selectedJobOffer;

    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'joboffer.title' => 'required|string|max:255',
        'joboffer.description' => 'required|string',
        'joboffer.type' => 'required|string',
        'joboffer.location' => 'required|string',
        'joboffer.salary' => 'required|numeric',
        'joboffer.start_date' => 'nullable|date',
        'joboffer.end_date' => 'nullable|date|after_or_equal:joboffer.start_date',
        'joboffer.experience_required' => 'nullable|string|max:255',
        'joboffer.contact_details' => 'required|string',
        'joboffer.category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:1024', // 1MB máximo
    ];

    public function render()
    {
        // Filtrar ofertas de trabajo por el usuario autenticado y el campo de búsqueda
        $joboffers = Joboffer::where('user_id', Auth::id())
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(6);

        // Obtener todas las categorías para el formulario de creación/edición
        $categories = Category::all();

        return view('joboffer.crud-joboffer', compact('joboffers', 'categories'));
    }

    public function create()
    {
        $this->reset(['joboffer', 'image']);
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function openPreviewModal($jobOfferId)
    {
        $this->selectedJobOffer = Joboffer::find($jobOfferId);
        $this->showPreviewModal = true;
    }

    public function closePreviewModal()
    {
        $this->showPreviewModal = false;
    }

    public function store()
    {
        // Validar los datos del formulario
        $this->validate();

        // Asignar un valor predeterminado a 'status' si está vacío
        $this->joboffer['status'] = $this->joboffer['status'] ?? 'inactive'; // 'inactive' como valor predeterminado

        // Agregar el ID del usuario actual a los datos de la oferta de trabajo
        $this->joboffer['user_id'] = Auth::id();

        // Procesar la imagen si existe
        if ($this->image) {
            $this->joboffer['image'] = $this->image->store('joboffer_images', 'public');
        }

        // Crear la oferta de trabajo en la base de datos
        Joboffer::create($this->joboffer);

        // Limpiar el formulario y cerrar el modal
        $this->reset(['joboffer', 'image']);
        $this->isOpen = false;

        // Emitir el evento para actualizar la lista de ofertas de trabajo
        $this->emitTo('CrudJoboffer', 'render');

        // Mostrar mensaje de éxito
        session()->flash('message', 'Oferta laboral creada con éxito.');
    }

    public function edit(Joboffer $joboffer)
    {
        // Cargar los datos de la oferta en el formulario para editar
        $this->joboffer = $joboffer->toArray();
        $this->isOpen = true;
    }

    public function update()
    {
        // Validar los datos del formulario
        $this->validate();

        // Buscar la oferta de trabajo a actualizar
        $joboffer = Joboffer::findOrFail($this->joboffer['id']);

        // Asignar un valor predeterminado a 'status' si está vacío
        $this->joboffer['status'] = $this->joboffer['status'] ?? 'inactive';

        // Procesar la imagen si se ha subido una nueva
        if ($this->image) {
            // Eliminar la imagen anterior si existe
            if ($joboffer->image) {
                Storage::disk('public')->delete($joboffer->image);
            }

            // Guardar la nueva imagen
            $this->joboffer['image'] = $this->image->store('joboffer_images', 'public');
        }

        // Actualizar los datos de la oferta
        $joboffer->update($this->joboffer);

        // Limpiar el formulario y cerrar el modal
        $this->reset(['joboffer', 'image']);
        $this->isOpen = false;

        // Emitir el evento para actualizar la lista de ofertas de trabajo
        $this->emitTo('CrudJoboffer', 'render');

        // Mostrar mensaje de éxito
        session()->flash('message', 'Oferta laboral actualizada con éxito.');
    }

    public function delete($id)
    {
        // Buscar la oferta de trabajo a eliminar
        $joboffer = Joboffer::findOrFail($id);

        // Eliminar la imagen si existe
        if ($joboffer->image) {
            Storage::disk('public')->delete($joboffer->image);
        }

        // Eliminar la oferta laboral
        $joboffer->delete();

        // Emitir el evento para recargar la lista de ofertas
        $this->emitTo('CrudJoboffer', 'render');

        // Mostrar mensaje de éxito
        session()->flash('message', 'Oferta laboral eliminada con éxito.');
    }
}
