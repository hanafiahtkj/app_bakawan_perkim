<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetupRtlh;
use DB; 
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;

class SetupWilayahController extends AdminController
{
    public function index()
    {
        // echo $id; die;
        $setups = Kecamatan::where('city_id', 6371)->get();
        return view('admin/pages/setup-wilayah', ['setups' => $setups]);
        // return $dataTable->render('admin/pages/user-list');
    }

    public function store(Request $request)
    {
        $setups = $request->data;

        foreach ($setups as $key => $setup) {
            $id = $setup['id'];

            if ($id != '')
            {
                $kelurahan = Kelurahan::find($id);
                if ($kelurahan) {
                    $kelurahan->update([
                        'id'        => $id,
                        'district_id' => $setup['district_id'],
                        'name'      => $setup['name'],
                        //'status'    => ($setup['status'] == 1) ? 1 : 0 ,
                    ]);
                }
                else {
                    Kelurahan::create([
                        'id'        => $id,
                        'district_id' => $setup['district_id'],
                        'name'      => $setup['name'],
                        //'status'    => ($setup['status'] == 1) ? 1 : 0 ,
                    ]);
                }
            } 
        }

        return response()->json([
            'status'	=> true,
            'msg'		=> 'Sukses data Tersimpan',
            'setups'    => $setups
        ]);
    }

    public function getDataSetups($id)
    {
        $setups = Kelurahan::where('district_id', $id)->get();
        return response()->json([
            'setups' => $setups,
        ]);
    }

    public function destroy($id)
    {
        Kelurahan::where('id',$id)->delete();

        return response()->json([
            'status'	=> true,
            'msg'		=> 'Sukses data dihapus',
        ]);
    }
}
