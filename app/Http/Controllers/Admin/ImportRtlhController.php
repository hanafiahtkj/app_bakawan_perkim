<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use App\Models\SetupRtlh;
use App\Models\Rtlh;
use App\Models\RtlhBukti;
use App\Models\RtlhVerif;
use App\Models\RtlhVerifFiles;
use App\Models\RtlhKondisiRumah;
use App\Models\RtlhKelayakanRumah;
use App\Imports\RtlhImport;
use App\Imports\RtlhImport2;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ImportRtlhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kecamatan' => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
        ];
        return view('admin/pages/import-rtlh', $data);
    }

    // public function upload(Request $request)
    // {
    //     // $sql = DB::table('__rtlh')->insert([
    //     //     'nik' => 12345678
    //     // ]);

    //     Excel::import(new RtlhImport, request()->file('file_excel'));

    //     return response()->json([
    //         'status' => true,
    //     ]);
    // }

    public function upload(Request $request)
    {
        Excel::import(new RtlhImport2, request()->file('file_excel2'));

        return response()->json([
            'status' => true,
        ]);
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
}
