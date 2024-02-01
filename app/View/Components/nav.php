<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class nav extends Component
{
    // Making this items public , Laravel will automatically pass it to the view and can be used there without passing it in render method .
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items=config('nav');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}
