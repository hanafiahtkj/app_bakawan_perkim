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
        $posts = Posts::where('status','Publish')->where('id', '<>', 6)->get();
        return view('layouts.app', compact('posts'));
    }
}
