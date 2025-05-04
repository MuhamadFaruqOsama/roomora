<?php

namespace App\View\Components\mobile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class History extends Component
{
    public $type;
    public $title;
    public $time;
    public $status;
    public $description;
    public $image;
    public $class;
    /** 
     * Create a new component instance.
     */
    public function __construct($type, $title, $time, $status, $description, $image = null, $class)
    {
        $this->type = $type;
        $this->title = $title;
        $this->time = $time;
        $this->status = $status;
        $this->description = $description;
        $this->image = $image;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile.history');
    }
}
