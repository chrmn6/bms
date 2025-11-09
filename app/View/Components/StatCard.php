<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public $iconColor;
    public $textColor;
    public $cardBg;
    public $label;
    public $count;



    /**
     * Create a new component instance.
     */
    public function __construct($iconColor, $cardBg, $textColor, $count, $label)
    {
        $this->iconColor = $iconColor;
        $this->cardBg = $cardBg;
        $this->textColor = $textColor;
        $this->label = $label;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stat-card');
    }
}
