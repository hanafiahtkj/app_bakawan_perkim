<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryDirectory;
use App\Models\GalleryFiles;
use App\Models\Posts;
use App\Models\GalleryVideo;

class PageController extends Controller
{
    public function saratKetentuan()
    {
        return view('sarat_ketentuan');
    }

    public function gallery()
    {
        $gallery = GalleryDirectory::get();
        $video   = GalleryVideo::get();
        return view('gallery', compact('gallery', 'video'));
    }

    public function video()
    {
        $gallery = GalleryVideo::get();
        return view('video', compact('gallery'));
    }

    public function post($id)
    {
        $post = Posts::find($id);
        return view('post', compact('post'));
    }
}
