<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetupVerif;
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
        return view('admin/pages/setup-verif', ['setups' => $setups]);
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
        $setups = $request->data;

        foreach ($setups as $key => $setup) {
            $id = $setup['id'];

            if ($id != '')
            {
                $setupRtlh = SetupVerif::find($id);
                $setupRtlh->update([
                    'parent_id' => $setup['parent_id'],
                    'name'      => $setup['name'],
                    'status'    => ($setup['status'] == 1) ? 1 : 0 ,
                ]);
            } 
            else {
                SetupVerif::create([
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

    public function getDataSetups($id)
    {
        $setups = DB::table('setup_verif')->where('parent_id',$id)->get();

        return response()->json([
            'setups' => $setups,
        ]);
    }
}
