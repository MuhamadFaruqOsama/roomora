<?php

namespace App\View\Components\mobile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MobileHeader extends Component
{
    public $title;
    public $backBtn;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $backBtn = false)
    {
        $this->title = $title;
        $this->backBtn = $backBtn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile.mobile-header');
    }
}
