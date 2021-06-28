<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Rtlh;
use App\Models\Rtlh2;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use App\Models\SetupRtlh;
use DB;

class RtlhImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $temp = [];
            foreach ($row as $key => $value) {
                $temp[] = $value;
            }

            //var_dump($rows); die;

            //echo count($temp); die;

            if (count($temp) != 37) {
                continue;
            }

            // try{
                //DB::beginTransaction();

                $id_kelurahan = $temp[0];

                $kelurahan = Kelurahan::where('id', $id_kelurahan)->first();

                //var_dump($kelurahan); die;

                if($kelurahan) {
                    $id_kecamatan = $kelurahan->district_id;
                }
                else {
                    $id_kecamatan = null;
                }

                //echo $id_kecamatan; die;
                
                if ($temp[3] != null && $temp[3] != '') {
                    $jenis_kel = SetupRtlh::firstOrCreate([
                        'parent_id' => 4,
                        'name'      => $temp[3]
                    ]);
                }

                if ($temp[7] != null && $temp[7] != '') {
                    $jenis_pek = SetupRtlh::firstOrCreate([
                        'parent_id' => 5,
                        'name'      => $temp[7]
                    ]);
                }

                if ($temp[8] != null && $temp[8] != '') {
                    $jml_penghasilan = SetupRtlh::firstOrCreate([
                        'parent_id' => 6,
                        'name'      => $temp[8]
                    ]);
                }

                if ($temp[9] != null && $temp[9] != '') {
                    $stts_tanah = SetupRtlh::firstOrCreate([
                        'parent_id' => 7,
                        'name'      => $temp[9]
                    ]);
                }

                if ($temp[10] != null && $temp[10] != '') {
                    $stts_rumah = SetupRtlh::firstOrCreate([
                        'parent_id' => 8,
                        'name'      => $temp[10]
                    ]);
                }

                if ($temp[11] != null && $temp[11] != '') {
                    $stts_rumah_lain = SetupRtlh::firstOrCreate([
                        'parent_id' => 10,
                        'name'      => $temp[11]
                    ]);
                }

                if ($temp[12] != null && $temp[12] != '') {
                    $stts_tanah_lain = SetupRtlh::firstOrCreate([
                        'parent_id' => 9,
                        'name'      => $temp[12]
                    ]);
                }

                if ($temp[14] != null && $temp[14] != '') {
                    $pondasi = SetupRtlh::firstOrCreate([
                        'parent_id' => 12,
                        'name'      => $temp[14]
                    ]);
                }

                if ($temp[15] != null && $temp[15] != '') {
                    $kondisi_kolom = SetupRtlh::firstOrCreate([
                        'parent_id' => 13,
                        'name'      => $temp[15]
                    ]);
                }

                if ($temp[16] != null && $temp[16] != '') {
                    $kondisi_konstruksi = SetupRtlh::firstOrCreate([
                        'parent_id' => 14,
                        'name'      => $temp[16]
                    ]);
                }

                if ($temp[17] != null && $temp[17] != '') {
                    $jendela = SetupRtlh::firstOrCreate([
                        'parent_id' => 15,
                        'name'      => $temp[17]
                    ]);
                }

                if ($temp[18] != null && $temp[18] != '') {
                    $ventilasi = SetupRtlh::firstOrCreate([
                        'parent_id' => 16,
                        'name'      => $temp[18]
                    ]);
                }

                if ($temp[19] != null && $temp[19] != '') {
                    $stts_wc = SetupRtlh::firstOrCreate([
                        'parent_id' => 17,
                        'name'      => $temp[19]
                    ]);
                }

                if ($temp[20] != null && $temp[20] != '') {
                    $sumber_air_minum = SetupRtlh::firstOrCreate([
                        'parent_id' => 19,
                        'name'      => $temp[20]
                    ]);
                }

                if ($temp[21] != null && $temp[21] != '') {
                    $jarak_air_tpa = SetupRtlh::firstOrCreate([
                        'parent_id' => 18,
                        'name'      => $temp[21]
                    ]);
                }

                if ($temp[22] != null && $temp[22] != '') {
                    $sumber_listrik = SetupRtlh::firstOrCreate([
                        'parent_id' => 20,
                        'name'      => $temp[22]
                    ]);
                }

                if ($temp[25] != null && $temp[25] != '') {
                    $material_atap = SetupRtlh::firstOrCreate([
                        'parent_id' => 21,
                        'name'      => $temp[25]
                    ]);
                }

                if ($temp[26] != null && $temp[26] != '') {
                    $kondisi_atap = SetupRtlh::firstOrCreate([
                        'parent_id' => 22,
                        'name'      => $temp[26]
                    ]);
                }

                if ($temp[27] != null && $temp[27] != '') {
                    $material_dinding = SetupRtlh::firstOrCreate([
                        'parent_id' => 23,
                        'name'      => $temp[27]
                    ]);
                }

                if ($temp[28] != null && $temp[28] != '') {
                    $kondisi_dinding = SetupRtlh::firstOrCreate([
                        'parent_id' => 24,
                        'name'      => $temp[28]
                    ]);
                }

                if ($temp[29] != null && $temp[29] != '') {
                    $material_lantai = SetupRtlh::firstOrCreate([
                        'parent_id' => 25,
                        'name'      => $temp[29]
                    ]);
                }

                if ($temp[30] != null && $temp[30] != '') {
                    $kondisi_lantai = SetupRtlh::firstOrCreate([
                        'parent_id' => 24,
                        'name'      => $temp[30]
                    ]);
                }

                if ($temp[35] != null && $temp[35] != '') {
                    $pendidikan = SetupRtlh::firstOrCreate([
                        'parent_id' => 160,
                        'name'      => $temp[35]
                    ]);
                }
                
                if ($temp[36] != null && $temp[36] != '') {
                    $kawasan_rumah = SetupRtlh::firstOrCreate([
                        'parent_id' => 161,
                        'name'      => $temp[36]
                    ]);
                }

                $luas = strtoupper($temp[23]);
                //$luas = explode("X",$luas);
                $pos  = strpos($luas, 'X');
                if ($pos) 
                {
                    $luas = explode("X",$luas);
                    $panjang = (int) $luas[0];
                    $lebar = (int) $luas[1];
                }
                else {
                    $panjang = null;
                    $lebar = null;
                }

                $data = [
                    'id_kecamatan2'   => $id_kecamatan,
                    'id_kelurahan2'   => $id_kelurahan,
                    'nama_lengkap'    => $temp[2],
                    'jenis_kelamin'   => ($temp[3] == null && $temp[3] == '') ? null : $jenis_kel->id, //$temp[3]
                    'nik'             => $temp[4],
                    'alamat_lengkap'  => $temp[5],
                    'jml_kk'          => $temp[6],
                    'jenis_pekerjaan' => ($temp[7] == null && $temp[7] == '') ? null : $jenis_pek->id, //$temp[7],
                    'jml_penghasilan' => ($temp[8] == null && $temp[8] == '') ? null : $jml_penghasilan->id, //$temp[8],
                    'stts_tanah'      => ($temp[9] == null && $temp[9] == '') ? null : $stts_tanah->id,
                    'stts_rumah'      => ($temp[10] == null && $temp[10] == '') ? null : $stts_rumah->id,
                    'stts_rumah_lain' => ($temp[11] == null && $temp[11] == '') ? null : $stts_rumah_lain->id,
                    'stts_tanah_lain' => ($temp[12] == null && $temp[12] == '') ? null : $stts_tanah_lain->id,
                    'pernah_dibantu'  => 0, //$temp[13],
                    'pondasi'         => ($temp[14] == null && $temp[14] == '') ? null : $pondasi->id, //$temp[14],
                    'kondisi_kolom'   => ($temp[15] == null && $temp[15] == '') ? null : $kondisi_kolom->id, //$temp[15],
                    'kondisi_konstruksi' => ($temp[16] == null && $temp[16] == '') ? null : $kondisi_konstruksi->id, //$temp[16],
                    'jendela'         => ($temp[17] == null && $temp[17] == '') ? null : $jendela->id,
                    'ventilasi'       => ($temp[18] == null && $temp[18] == '') ? null : $ventilasi->id, //$temp[18],
                    'stts_wc'         => ($temp[19] == null && $temp[19] == '') ? null : $stts_wc->id, //$temp[19,
                    'sumber_air_minum'=> ($temp[20] == null && $temp[20] == '') ? null : $sumber_air_minum->id, //$temp[20],
                    'jarak_air_tpa'   => ($temp[21] == null && $temp[21] == '') ? null : $jarak_air_tpa->id, //$temp[21],
                    'sumber_listrik'  => ($temp[22] == null && $temp[22] == '') ? null : $sumber_listrik->id, //$temp[22],
                    'panjang'         => $panjang, //$temp[23],
                    'lebar'           => $lebar, //$temp[23],
                    'jml_penghuni'    => $temp[24],
                    'material_atap'   => ($temp[25] == null && $temp[25] == '') ? null : $material_atap->id, //$temp[25],
                    'kondisi_atap'    => ($temp[26] == null && $temp[26] == '') ? null : $kondisi_atap->id, //$temp[26],
                    'material_dinding'=> ($temp[27] == null && $temp[27] == '') ? null : $material_dinding->id, //$temp[27],
                    'kondisi_dinding' => ($temp[28] == null && $temp[28] == '') ? null : $kondisi_dinding->id, //$temp[28],
                    'material_lantai' => ($temp[29] == null && $temp[29] == '') ? null : $material_lantai->id, //$temp[29],
                    'kondisi_lantai'  => ($temp[30] == null && $temp[30] == '') ? null : $kondisi_lantai->id, //$temp[30],
                    'koordinat_rumah' => $temp[31].','.$temp[32],
                    'umur'            => (int) $temp[34],
                    'pendidikan'      => ($temp[35] == null && $temp[35] == '') ? null : $pendidikan->id, //$temp[37],
                    'kawasan_rumah'   => ($temp[36] == null && $temp[36] == '') ? null : $kawasan_rumah->id, //$temp[36],
                ];

                //var_dump($data); die;

                $rtlh = Rtlh2::create($data);
                // echo $rtlh->id; die;
                // var_dump($sql); die();


                // $data = [
                //     'kecamatan'         => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
                //     'jenis_kel'         => SetupRtlh::where('parent_id', 4)->get(),
                //     'jenis_pek'         => SetupRtlh::where('parent_id', 5)->get(),
                //     'jml_penghasilan'   => SetupRtlh::where('parent_id', 6)->get(),
                //     'stts_tanah'        => SetupRtlh::where('parent_id', 7)->get(),
                //     'stts_rumah'        => SetupRtlh::where('parent_id', 8)->get(),
                //     'stts_tanah_lain'   => SetupRtlh::where('parent_id', 10)->get(),
                //     'stts_rumah_lain'   => SetupRtlh::where('parent_id', 10)->get(),
                //     'bukti_kepemilikan' => SetupRtlh::where('parent_id', 11)->get(),
                //     'pondasi'           => SetupRtlh::where('parent_id', 12)->get(),
                //     'kondisi_kolom'     => SetupRtlh::where('parent_id', 13)->get(),
                //     'kondisi_konstruksi'=> SetupRtlh::where('parent_id', 14)->get(),
                //     'jendela'           => SetupRtlh::where('parent_id', 15)->get(),
                //     'ventilasi'         => SetupRtlh::where('parent_id', 16)->get(),
                //     'stts_wc'           => SetupRtlh::where('parent_id', 17)->get(),
                //     'jarak_air_tpa'     => SetupRtlh::where('parent_id', 18)->get(),
                //     'sumber_air_minum'  => SetupRtlh::where('parent_id', 19)->get(),
                //     'sumber_listrik'    => SetupRtlh::where('parent_id', 20)->get(),
                //     'material_atap'     => SetupRtlh::where('parent_id', 21)->get(),
                //     'kondisi_atap'      => SetupRtlh::where('parent_id', 22)->get(),
                //     'material_dinding'  => SetupRtlh::where('parent_id', 23)->get(),
                //     'kondisi_dinding'   => SetupRtlh::where('parent_id', 24)->get(),
                //     'material_lantai'   => SetupRtlh::where('parent_id', 25)->get(),
                //     'kondisi_lantai'    => SetupRtlh::where('parent_id', 26)->get(),
                //     'profile'           => Auth::user(),
                // ];

                // $query = DB::table('setup_rtlh');

                // $id_kelurahan = $temp[0];
                // $kelurahan = Kelurahan::where('id', $id_kelurahan)->first();
                // // var_dump($kelurahan);
                // // die;
                // $id_kecamatan = $kelurahan->district_id;

                // //echo $id_kecamatan; die;
                
                // Rtlh::create([
                //     'id_user'        => Auth::user()->id,
                //     'nik'            => $temp[4],
                //     'nama_lengkap'   => $temp[2],
                //     'id_kecamatan'   => $id_kelurahan,
                //     'id_kelurahan'   => $id_kecamatan,
                //     'alamat_lengkap' => $temp[6],
                //     'tgl_lahir'      => null,
                //     'jenis_kelamin'  => $temp[6],
                //     'jenis_pekerjaan'=> $temp[7],
                //     'jml_penghasilan'=> $temp[11],
                //     'pernah_dibantu' => null,
                //     'bantuan_dari'   => null,
                //     'is_old'         => 0,
                // ]);

                //DB::commit();

                // die();

                // return response()->json([
                //     'status' => false,
                //     'msg' => $e->getMessage(),
                // ]);

                // die;
            
            // }catch(\Exception $e){
            //     //dd($e);
            //     DB::rollback();

            //     echo $e->getMessage(); die;

            //     return response()->json([
            //         'status' => false,
            //         'msg' => $e->getMessage(),
            //     ]);

            //     die;
            // }
        }
        //die;
    }

    // public function headingRow(): int
    // {
    //     return 1;
    // }
}
