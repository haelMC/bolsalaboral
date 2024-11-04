<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public $title;
    public $subtitle;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $subtitle
     */
    public function __construct($title = 'Título por defecto', $subtitle = 'Subtítulo por defecto')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.banner');
    }
}
