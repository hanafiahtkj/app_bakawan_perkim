<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Kecamatan;
use App\Models\BantaranSungai;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use DB;

class BantaranSungaiController extends Controller
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
        return view('admin/pages/bantaran-sungai-list', $data);
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

            $input = $request->all();
            BantaranSungai::create($input);

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'status' => false,
                'msg' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => true,
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
        try{
            DB::beginTransaction();

            $data = BantaranSungai::find($id);
            $input = $request->all();
            $data->update($input);

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'status' => false,
                'msg' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BantaranSungai::find($id)->delete();
        return response()->json([
            'status' => true,
        ]);
    }

    public function getDataTables(Request $request)
    {
        $query = BantaranSungai::orderBy('id','DESC');

        return Datatables::of($query)
            ->addColumn('kecamatan',function(BantaranSungai $q){
                return ($q->kecamatan) ? $q->kecamatan->name : '-';
            })
            ->addColumn('kelurahan',function(BantaranSungai $q){
                return ($q->kelurahan) ? $q->kelurahan->name : '-';
            })
            ->make(true);
    }
}
