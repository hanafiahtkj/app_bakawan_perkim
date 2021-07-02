<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Models\User;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'profile' => Auth::user(),
            'kecamatan' => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
        ];

        //var_dump($data); die;
        return view('profile-form', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'name' => 'required',
            'username'   => 'required|unique:users,username,'.$id,
            'password' => 'same:confirm-password',
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
    
        return redirect()->route('dashboard')
            ->with('success','User updated successfully');
    }
}
