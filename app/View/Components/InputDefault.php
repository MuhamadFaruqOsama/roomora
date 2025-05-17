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
    public $isReadOnly;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $placeholder, $type, $value = null, $isRequired = true, $isReadOnly = false)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;  
        $this->isRequired = $isRequired;
        $this->isReadOnly = $isReadOnly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-default');
    }
}
