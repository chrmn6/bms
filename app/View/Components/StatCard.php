<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public $bgColor;
    public $count;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($bgColor, $count, $label)
    {
        $this->bgColor = $bgColor;
        $this->count = $count;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stat-card');
    }
}
