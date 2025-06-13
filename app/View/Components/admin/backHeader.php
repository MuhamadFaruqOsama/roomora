<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class backHeader extends Component
{
    public $parentDirectory;
    public $currentDirectory;
    public $menu;
    public $id;
    /**
     * Create a new component instance.
     */
    public function __construct($parentDirectory, $currentDirectory, $id = null, $menu = false)
    {
        $this->parentDirectory = $parentDirectory;
        $this->currentDirectory = $currentDirectory;
        $this->menu = $menu;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.back-header');
    }
}
