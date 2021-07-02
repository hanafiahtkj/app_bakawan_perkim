<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/pages/post-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = array('Publish', 'Pending');
        return view('admin/pages/post-form', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = [
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
        ];

        $request->validate($validasi);

        $posts = Posts::create([
            'id_user'      => Auth::user()->id,
            'title'        => $request->title,
            'content'      => $request->content,
            'status'       => $request->status,
        ]);

        return redirect()->route('posts.index')
            ->with('success','Data behasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Posts::find($id);
        $data = [
            'posts'      => $posts,
            'status'     => array('Publish', 'Pending'),
        ];
        return view('admin/pages/post-form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = [
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
        ];

        $request->validate($validasi);
    
        $posts = Posts::find($id);
        $posts->update([
            'title'        => $request->title,
            'content'      => $request->content,
            'status'       => $request->status,
        ]);
    
        return redirect()->route('posts.index')
                        ->with('success','Data berhasil diupdated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posts::find($id)->delete();

        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function getDataTables(Request $request)
    {
        $query = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.id_user')
            ->select('posts.*', 
                'users.name as author',
                DB::raw("DATE_FORMAT(posts.created_at, '%d-%m-%Y') as tanggal")
            )
            ->where('posts.id', '<>', 6);
        
        return DataTables::of($query)->toJson();
    }

    public function upload(Request $request)
	{   
        $validasi = [
            'file'  => 'required|mimes:jpg,bmp,png',
        ];

        $validator = Validator::make($request->all(), $validasi);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'error'  => $errors->first('file')
            ]);
        }

        $upload = $request->file('file');
        if($upload) {
            $upload_path = 'uploads/posts';
            $filename = time().'_'.$upload->getClientOriginalName();
            $upload->move($upload_path, $filename);
            $path = $upload_path.'/'.$filename;
            $json['url'] = $path;
        }

		return response()->json($json);
    }
}
