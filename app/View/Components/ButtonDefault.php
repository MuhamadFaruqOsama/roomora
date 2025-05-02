<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonDefault extends Component
{
    public $type;
    public $text;
    public $name;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $text, $name)
    {
        $this->type = $type;
        $this->text = $text;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-default');
    }
}
