<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\GalleryDirectory;
use App\Models\GalleryFiles;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Filesystem\Filesystem;
// use Illuminate\Contracts\Filesystem;
use Illuminate\Filesystem;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/pages/gallery-form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['images'] = array();
        return view('admin/pages/gallery-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createFolder(Request $request)
	{
        $validator = Validator::make($request->all(), array(
            'folder' => 'required'
        ));

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
		
		$directory = 'uploads/gallery/';
	
        if (!is_dir($directory)) {
            $json['error'] = 'Error in derectory';
        }
			
        $folder = basename(html_entity_decode($request->input('folder'), ENT_QUOTES, 'UTF-8'));				
        if (is_dir($directory . $folder)) {
            $json['error'] = 'Warning: A file or directory with the same name already exists!';
        }

        if (!isset($json['error'])) {
            mkdir($directory . $folder, 0777);
            chmod($directory . $folder, 0777);

            GalleryDirectory::create([
                'name' => $folder,
                'path' => $directory.$folder
            ]);

            $json['success'] = 'Success: Directory created!';
        }
            
        return response()->json($json);
    }
    
    public function upload(Request $request)
	{   
        $id_directory = $request->input('id_directory');
        //echo $id_directory; die;
        $directory = GalleryDirectory::where('id', $id_directory)->first();
        $directory = 'uploads/gallery/' . $directory->name . '/';

		if (!is_dir($directory)) {
			$json['error'] = 'Error in derectory';
		} else {
            $file = '';
            $upload = $request->file('file');
            if($upload) {
                $upload_path = $directory;
                $filename = $upload->getClientOriginalName();
                $upload->move($upload_path, $filename);
                $path = $upload_path.$filename;

                GalleryFiles::create([
                    'id_directory' => $id_directory,
                    'path'         => $path,
                    'file_name'    => $filename,
                ]);

                $json['success'] = 'File succesfully uploaded';
            }
		}

		return response()->json($json);
    }
    
    public function getDirectory()
    {
        $directory = GalleryDirectory::get();

        return response()->json([
            'directory' => $directory,
        ]);
    }

    public function getFiles($id_directory)
    {
        $files = GalleryFiles::where('id_directory',$id_directory)->get();

        return response()->json([
            'files' => $files,
        ]);
    }

    public function delete(Request $request) 
	{
		if ($request->input('path')) {
			$paths = $request->input('path');
		} else {
			$paths = array();
		}

		if (!empty($paths)) {
			foreach ($paths as $path) {
                //echo $path; die;
				if (is_file($path)) {
                    unlink($path);
                    GalleryFiles::where('path', $path)->delete();
				} elseif (is_dir($path)) {
                    // File::deleteDirectory(public_path($path));
                    // Storage::deleteDirectory(public_path($path));
					// delete_files($path, TRUE);
                    rmdir($path);
                    // echo $path; die;
                    // Storage::deleteDirectory($path);
                    GalleryDirectory::where('path', $path)->delete();
				}
			}
		}

		$json['success'] = 'Success: Your file or directory has been deleted!';

		return response()->json($json);
	}
}
