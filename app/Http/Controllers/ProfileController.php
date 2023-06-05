<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Models\User;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use Intervention\Image\ImageManagerStatic as Image;

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
            $file = $request->file('foto');
            $imageName = time().'_'.$file->getClientOriginalName();
            $image = Image::make($file);
            $image->exif()->encode();
            $image->save(public_path($upload_path . $imageName));
            $input['foto'] = $upload_path . $imageName;
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('dashboard')
            ->with('success','User updated successfully');
    }
}
