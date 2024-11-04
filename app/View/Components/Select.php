<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $id;
    public $class;
    public $options;

    public function __construct($id, $class = '', $options = [])
    {
        $this->id = $id;
        $this->class = $class;
        $this->options = $options;
    }

    public function render()
    {
        return view('components.select');
    }
}
