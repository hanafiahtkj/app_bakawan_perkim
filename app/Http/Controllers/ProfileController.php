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
        $user = User::find($id);

        $rules = [
            'name' => 'required',
            'username'   => 'required|unique:users,username,'.$id,
            'foto'       => 'mimes:jpg,bmp,png',
        ];

        // Hanya validasi password jika ada input password baru
        if (!empty($request->input('password'))) {
            $rules['password'] = 'required|min:8|same:password_confirmation';
            $rules['old_password'] = [
                'required',
                // Rule untuk memeriksa kecocokan password lama
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Password lama tidak cocok.');
                    }
                },
            ];
        }

        $this->validate($request, $rules);

        $input = $request->all();

        // Hapus password lama dari input karena tidak disimpan
        $input = Arr::except($input, array('old_password'));

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            // Jika password baru kosong, hapus password dari input agar tidak mengganti password
            $input = Arr::except($input, array('password', 'password_confirmation'));
        }

        // Upload foto bangunan
        $upload = $request->file('foto');
        if ($upload) {
            $upload_path = 'uploads/foto/';
            $file = $request->file('foto');
            $imageName = time().'_'.$file->getClientOriginalName();
            $image = Image::make($file);
            $image->save(public_path($upload_path . $imageName));
            $input['foto'] = $upload_path . $imageName;
        }

        $user->update($input);

        return redirect()->route('dashboard')
            ->with('success','User updated successfully');
    }
}
