<?php

namespace App\View\Components\mobile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClassCard extends Component
{
    public $id;
    public $image;
    public $name;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $image, $name)
    {
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile.class-card');
    }
}
