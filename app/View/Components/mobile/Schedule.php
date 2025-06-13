<?php

namespace App\View\Components\mobile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Schedule extends Component
{
    public $scheduleData;
    public $className;
    public $modalKey = null;
    public $isProfileDataFilled;
    public $classId;
    /**
     * Create a new component instance.
     */
    public function __construct($scheduleData, $className, $isProfileDataFilled, $classId,  $modalKey = null)
    {
        $this->scheduleData = $scheduleData;
        $this->className = $className;
        $this->modalKey = $modalKey;
        $this->isProfileDataFilled = $isProfileDataFilled;
        $this->classId = $classId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile.schedule');
    }
}
