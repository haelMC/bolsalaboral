<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestComponent extends Component
{
    public $message = "Este es un mensaje de prueba";

    public function updateMessage()
    {
        $this->message = "¡El botón ha funcionado!";
    }

    public function render()
    {
        return view('livewire.test-component');
    }
}
