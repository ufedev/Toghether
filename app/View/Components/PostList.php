<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PostList extends Component
{

    public $posts;

    /**
     * Create a new component instance.
     */
    public function __construct($posts)
    {
        //
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-list');
    }
}
