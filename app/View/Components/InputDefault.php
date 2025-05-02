<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputDefault extends Component
{
    public $name;
    public $value;
    public $placeholder;
    public $type;
    public $isRequired;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $placeholder, $type, $isRequired = true, $value = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->isRequired = $isRequired;
        $this->value = $value; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-default');
    }
}
