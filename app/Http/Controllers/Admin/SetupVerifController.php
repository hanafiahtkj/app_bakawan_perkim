<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetupVerif;
use App\Models\SetupVerifField;
use App\Models\SetupVerifFieldValue;
use DB; 

class SetupVerifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setups = DB::table('setup_verif')->where('parent_id',0)->get();
        return view('admin/pages/setup-verif2', ['setups' => $setups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try{
            DB::beginTransaction();
            
            $dataField = [
                'id_setup'  => $request->input('id_setup'),
                'name'      => $request->input('name'),
                'type'      => $request->input('type'),
                'value'     => '',
                'status'    => $request->input('status'),
                'sort_order'=> $request->input('sort_order'),
            ];

            if ($id = $request->input('id')){
                $setupVerifField = SetupVerifField::find($id);
                $setupVerifField->update($dataField);
            } 
            else{
                $setupVerifField = SetupVerifField::create($dataField);
            }

            if ($data = $request->input('data')) {
                $arr_id = array_filter(array_column($data, 'id'));
                //var_dump($arr_id); die;
                DB::table('setup_verif_field_value')
                    ->whereNotIn('id', $arr_id)
                    ->where('setup_verif_field_id',$setupVerifField->id)
                    ->delete();

                foreach ($data as $key => $value) {
                    $dataValue = [
                        'setup_verif_field_id' => $setupVerifField->id,
                        'name'                 => $value['name'],
                        'sort_order'           => $value['sort_order']
                    ];

                    if ($value['id']) {
                        $setupVerifFieldValue = SetupVerifFieldValue::find($value['id']);
                        $setupVerifFieldValue->update($dataValue);
                    }
                    else {
                        $setupVerifFieldValue = SetupVerifFieldValue::create($dataValue);
                    }
                }
            }

            DB::commit();
            
        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'status' => false,
                'msg'	 => 'Gagal data Tersimpan',
            ]);
        }

        return response()->json([
            'status'	=> true,
            'msg'		=> 'Sukses data Tersimpan',
            // 'setups'    => $setups
        ]);
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
        DB::table('setup_verif_field')->where('id',$id)->delete();
        DB::table('setup_verif_field_value')->where('setup_verif_field_id',$id)->delete();

        return response()->json([
            'status'	=> true,
            'msg'		=> 'Sukses data dihapus',
            // 'setups'    => $setups
        ]);
    }

    public function getDataSetups($id)
    {
        $setups = DB::table('setup_verif_field')->where('id_setup',$id)->get();

        return response()->json([
            'setups' => $setups,
        ]);
    }

    public function getDataSetupsDtl($id)
    {
        $setup = DB::table('setup_verif_field')->where('id',$id)->first();
        $setup_value = DB::table('setup_verif_field_value')->where('setup_verif_field_id',$id)->get();

        return response()->json([
            'setup' => $setup,
            'setup_value' => $setup_value,
        ]);
    }
}
