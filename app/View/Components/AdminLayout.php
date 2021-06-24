<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DB;
use App\Models\Posts;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $setups = DB::table('setup_rtlh')->where('parent_id',0)->get();
        $posts = Posts::where('status','Publish')->get();
        return view('admin.layouts.app', ['setups' => $setups, 'posts' => $posts]);
    }
}
