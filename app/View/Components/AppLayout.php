<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Posts;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $posts = Posts::where('status','Publish')->get();
        return view('layouts.app', compact('posts'));
    }
}
