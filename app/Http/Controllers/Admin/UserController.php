<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kecamatan'         => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
        ];
        return view('admin/pages/user-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'kecamatan' => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
            'roles'     => Role::all(),
        ];
        return view('admin/pages/user-form', $data);
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
            'name'       => 'required|string|max:255',
            'username'   => 'required|min:5|unique:users',
            'password'   => 'required|string|confirmed|min:8',
            'foto'       => 'mimes:jpg,bmp,png',
        ];

        $id_role = $request->id_role;
        if ($id_role == 'General') {
            $validasi['id_kecamatan'] = 'required';
            $validasi['id_kelurahan'] = 'required';
        }

        // Upload
        $foto = '';
        $upload = $request->file('foto');
        if($upload) {
            $upload_path = 'uploads/foto/';
            $file = $request->file('foto');
            $imageName = time().'_'.$file->getClientOriginalName();
            $image = Image::make($file);
            $image->exif()->reset();
            $image->save(public_path($upload_path . $imageName));
            $input['foto'] = $upload_path . $imageName;
        }

        $request->validate($validasi);

        $user = User::create([
            'name'         => $request->name,
            'username'     => $request->username,
            //'email'      => $request->email,
            'password'     => Hash::make($request->password),
            'id_kecamatan' => $request->id_kecamatan,
            'id_kelurahan' => $request->id_kelurahan,
            'no_wa'        => $request->no_wa,
            'pekerjaan'    => $request->pekerjaan,
            'foto'         => $foto,
        ]);

        // event(new Registered($user));

        // Role
        $user->assignRole($id_role);

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        //var_dump($user); die;

        foreach($user->getRoleNames() as $v){
            $roleName = $v;
        }

        $data = [
            'kecamatan' => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
            'user'      => $user,
            'roleName'  => $roleName,
            'roles'     => Role::all(),
        ];
        return view('admin/pages/user-form', $data);
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
            'name'       => 'required|string|max:255',
            'username'   => 'required|unique:users,username,'.$id,
            'password'   => 'same:password_confirmation',
            'foto'       => 'mimes:jpg,bmp,png',
        ];

        $id_role = $request->id_role;
        if ($id_role == 'General') {
            $validasi['id_kecamatan'] = 'required';
            $validasi['id_kelurahan'] = 'required';
        }

        $request->validate($validasi);

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
            $image->exif()->reset();
            $image->save(public_path($upload_path . $imageName));
            $input['foto'] = $upload_path . $imageName;
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        // Role
        $id_role = $request->id_role;
        $user->assignRole($id_role);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function getDataTables(Request $request)
    {
        $users = User::orderBy('id','DESC');

        if ($id_kecamatan = $request->get('id_kecamatan')) {
            $users->where('id_kecamatan', $id_kecamatan);
        }

        if ($id_kelurahan = $request->get('id_kelurahan')) {
            $users->where('id_kelurahan', $id_kelurahan);
        }

        return Datatables::of($users)
            ->addColumn('role',function(User $users){
                foreach($users->getRoleNames() as $v){
                    return $v;
                }
            })
            ->addColumn('kecamatan',function(User $users){
                return ($users->kecamatan) ? $users->kecamatan->name : '-';
            })
            ->addColumn('kelurahan',function(User $users){
                return ($users->kelurahan) ? $users->kelurahan->name : '-';
            })
            ->make(true);
    }
}
