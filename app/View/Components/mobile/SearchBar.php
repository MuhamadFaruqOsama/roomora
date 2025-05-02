<?php

namespace App\View\Components\mobile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    public $name;
    public $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $placeholder)
    {
        $this->name = $name;
        $this->placeholder = $placeholder; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile.search-bar');
    }
}
