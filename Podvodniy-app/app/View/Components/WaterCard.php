<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WaterCard extends Component
{
    public $water;

    public function __construct($water)
    {
        $this->water = $water;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Closure|string
    {
        return view('components.water-card');
    }
}
