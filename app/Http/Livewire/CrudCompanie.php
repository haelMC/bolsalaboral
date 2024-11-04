<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;

class CrudCompanie extends Component
{
    public $isOpen = false;
    public $search, $company;

    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'company.name' => 'required',
        'company.description' => 'required',
        'company.location' => 'required',
        'company.email' => 'required|email',
        'company.address' => 'required',
        'company.phone' => 'required',
        'company.industry_sector' => 'nullable',
        'company.years_of_activity' => 'nullable|integer',
        'company.user_id' => 'required|exists:users,id',
    ];

    public function messages()
    {
        return [
            'company.name.required' => 'El nombre de la empresa es obligatorio.',
            'company.description.required' => 'La descripción de la empresa es obligatoria.',
            'company.location.required' => 'La ubicación de la empresa es obligatoria.',
            'company.email.required' => 'El correo electrónico de la empresa es obligatorio.',
            'company.email.email' => 'El correo electrónico de la empresa debe ser una dirección de correo válida.',
            'company.address.required' => 'La dirección de la empresa es obligatoria.',
            'company.phone.required' => 'El número de teléfono de la empresa es obligatorio.',
            'company.years_of_activity.integer' => 'Los años de actividad de la empresa deben ser un número entero.',
            'company.user_id.required' => 'El ID del usuario es obligatorio.',
            'company.user_id.exists' => 'El ID del usuario proporcionado no existe en la tabla de usuarios.',
        ];
    }

    public function render()
    {
        $companies = Company::where('name', 'LIKE', '%' . $this->search . '%')->latest('id')->paginate(6);

        $users = User::all();
        return view('companie.crud-companie', compact('companies', 'users'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->resetValidation();
        $this->company = new Company();
    }

    public function store()
    {
        $this->validate();

        $this->company->save();

        $this->reset(['isOpen', 'company']);
        $this->emitTo('CrudCompany', 'render');
        $this->emit('alert', 'Registro creado satisfactoriamente');
    }

    public function edit(Company $company)
    {
        $this->company = $company;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate();

        $this->company->save();

        $this->reset(['isOpen', 'company']);
        $this->emitTo('CrudCompany', 'render');
        $this->emit('alert', 'Registro actualizado satisfactoriamente');
    }

    public function delete($id)
    {
        Company::find($id)->delete();
    }
}
