<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rtlh;
use DB;

class ApiGisController extends Controller
{
    public function rtlh(Request $request)
    {
        $rtlh = DB::table('rtlh')
            ->join('rtlh_kondisi_rumah', 'rtlh_kondisi_rumah.id_rtlh', '=', 'rtlh.id')
            ->join('rtlh_kelayakan_rumah', 'rtlh_kelayakan_rumah.id_rtlh', '=', 'rtlh.id')
            ->leftJoin('setup_rtlh as setup13', 'setup13.id', '=', 'rtlh_kelayakan_rumah.stts_wc')
            ->leftJoin('setup_rtlh as setup18', 'setup18.id', '=', 'rtlh_kelayakan_rumah.kondisi_atap')
            ->leftJoin('setup_rtlh as setup20', 'setup20.id', '=', 'rtlh_kelayakan_rumah.kondisi_dinding')
            ->leftJoin('setup_rtlh as setup22', 'setup22.id', '=', 'rtlh_kelayakan_rumah.kondisi_lantai')
            ->leftJoin('setup_rtlh as setup24', 'setup24.id', '=', 'rtlh_kelayakan_rumah.jenis_kloset')
            ->select(
                'rtlh.nama_lengkap',
                'rtlh.alamat_lengkap',
                'rtlh_kondisi_rumah.foto_bangunan',
                'rtlh_kondisi_rumah.jml_penghuni',
                DB::raw("(rtlh_kondisi_rumah.panjang * rtlh_kondisi_rumah.lebar) as luas_rumah"),
                'setup18.name as kondisi_atap',
                'setup20.name as kondisi_dinding',
                'setup22.name as kondisi_lantai',
                'setup24.name as jenis_kloset',
                'setup13.name as kepemilikan_kamar_mandi',
                'rtlh_kondisi_rumah.koordinat_rumah',
            )
            ->where('rtlh.stts_verif', 1)
            ->where('rtlh.stts_realisasi', null)
            ->get();

        $json = array(
            "type" => "FeatureCollection"
        );

        foreach ($rtlh as $key => $value) {
			$string  = $value->koordinat_rumah;
			$pos 	 = strpos($string, ',');
			if ($pos)
			{
                $loc  = explode(",", $string);
                $json['features'][] = array(
                    'type'       => 'Feature',
                    'id'         => $key + 1,
                    'properties' => $value,
                    "geometry"   => array(
                        "type" => "Point",
                        "coordinates" => [$loc[1],$loc[0]]
                    )
                );
			}
        }

        return response()->json($json);
    }

    public function penerimaBantuan(Request $request)
    {
        $rtlh = DB::table('rtlh')
            ->join('rtlh_kondisi_rumah', 'rtlh_kondisi_rumah.id_rtlh', '=', 'rtlh.id')
            ->join('rtlh_kelayakan_rumah', 'rtlh_kelayakan_rumah.id_rtlh', '=', 'rtlh.id')
            ->leftJoin('setup_rtlh as setup13', 'setup13.id', '=', 'rtlh_kelayakan_rumah.stts_wc')
            ->leftJoin('setup_rtlh as setup18', 'setup18.id', '=', 'rtlh_kelayakan_rumah.kondisi_atap')
            ->leftJoin('setup_rtlh as setup20', 'setup20.id', '=', 'rtlh_kelayakan_rumah.kondisi_dinding')
            ->leftJoin('setup_rtlh as setup22', 'setup22.id', '=', 'rtlh_kelayakan_rumah.kondisi_lantai')
            ->leftJoin('setup_rtlh as setup24', 'setup24.id', '=', 'rtlh_kelayakan_rumah.jenis_kloset')
            ->select(
                'rtlh.nama_lengkap',
                'rtlh.alamat_lengkap',
                'rtlh_kondisi_rumah.foto_bangunan',
                'rtlh_kondisi_rumah.jml_penghuni',
                DB::raw("(rtlh_kondisi_rumah.panjang * rtlh_kondisi_rumah.lebar) as luas_rumah"),
                'setup18.name as kondisi_atap',
                'setup20.name as kondisi_dinding',
                'setup22.name as kondisi_lantai',
                'setup24.name as jenis_kloset',
                'setup13.name as kepemilikan_kamar_mandi',
                'rtlh_kondisi_rumah.koordinat_rumah',
            )
            ->where('rtlh.stts_realisasi', 1)
            ->get();

        $json = array(
            "type" => "FeatureCollection"
        );

        foreach ($rtlh as $key => $value) {
			$string  = $value->koordinat_rumah;
			$pos 	 = strpos($string, ',');
			if ($pos)
			{
                $loc  = explode(",", $string);
                $json['features'][] = array(
                    'type'       => 'Feature',
                    'id'         => $key + 1,
                    'properties' => $value,
                    "geometry"   => array(
                        "type" => "Point",
                        "coordinates" => [$loc[1],$loc[0]]
                    )
                );
			}
        }

        return response()->json($json);
    }
}
