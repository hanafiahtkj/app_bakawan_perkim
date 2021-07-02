<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;

class SyaratController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts = Posts::find(6);
        $data = [
            'posts'      => $posts,
            'status'     => array('Publish', 'Pending'),
        ];
        return view('admin/pages/syarat-form', $data);
    }

    public function update(Request $request)
    {
        $validasi = [
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
        ];

        $request->validate($validasi);
    
        $posts = Posts::find(6);
        $posts->update([
            'title'        => $request->title,
            'content'      => $request->content,
            'status'       => $request->status,
        ]);
    
        return redirect()->route('admin.syarat-ketentuan')
                        ->with('success','Data berhasil diupdated');
    }
}
