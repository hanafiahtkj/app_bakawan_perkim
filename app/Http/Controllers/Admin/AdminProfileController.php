<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Models\User;
use DB;

class AdminProfileController extends AdminController
{
    public function index()
    {
        $data = [
            'profile' => Auth::user(),
        ];
        //var_dump($data); die;
        return view('admin/pages/profile-form', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'name' => 'required',
            'username'   => 'required|unique:users,username,'.$id,
            //'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:password_confirmation',
            'foto'       => 'mimes:jpg,bmp,png',
            //'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        // Upload foto bangunan
        $upload = $request->file('foto');
        if ($upload) {
            $upload_path = 'uploads/foto/';
            $filename = time().'_'.$upload->getClientOriginalName();
            $upload->move($upload_path, $filename);
            $input['foto'] = $upload_path.'/'.$filename;
        }
    
        $user = User::find($id);
        $user->update($input);
    
        return redirect()->route('admin.profile')
                        ->with('success','User updated successfully');
    }
}
