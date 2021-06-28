<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetupRtlh;
use DB; 

class SetupRtlhController extends AdminController
{
    public function index()
    {
        // echo $id; die;
        $setups = DB::table('setup_rtlh')->where('parent_id',0)->get();
        return view('admin/pages/setup-rtlh', ['setups' => $setups]);
        // return $dataTable->render('admin/pages/user-list');
    }

    public function store(Request $request)
    {
        $setups = $request->data;

        foreach ($setups as $key => $setup) {
            $id = $setup['id'];

            if ($id != '')
            {
                $setupRtlh = SetupRtlh::find($id);
                $setupRtlh->update([
                    'parent_id' => $setup['parent_id'],
                    'name'      => $setup['name'],
                    'status'    => ($setup['status'] == 1) ? 1 : 0 ,
                ]);
            } 
            else {
                SetupRtlh::create([
                    'parent_id' => $setup['parent_id'],
                    'name'      => $setup['name'],
                    'status'    => ($setup['status'] == 1) ? 1 : 0 ,
                ]);
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
        $setups = DB::table('setup_rtlh')->where('parent_id',$id)->get();

        return response()->json([
            'setups' => $setups,
        ]);
    }

    public function destroy($id)
    {
        DB::table('setup_rtlh')->where('id',$id)->delete();

        return response()->json([
            'status'	=> true,
            'msg'		=> 'Sukses data dihapus',
        ]);
    }
}
