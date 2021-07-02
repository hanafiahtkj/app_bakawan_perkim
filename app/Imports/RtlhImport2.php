<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\SetupRtlh;
use App\Models\Rtlh;
use App\Models\RtlhBukti;
use App\Models\RtlhVerif;
use App\Models\RtlhVerifFiles;
use App\Models\RtlhKondisiRumah;
use App\Models\RtlhKelayakanRumah;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use DB;

class RtlhImport2 implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            //var_dump($rows);
            //var_dump($row); die();

            $temp = [];
            foreach ($row as $key => $value) {
                $temp[] = $value;
            }

            // echo count($temp); die;

            // var_dump($temp);
            // die;

            if (count($temp) < 47) {
                continue;
            }
            else{
                $nik = ($temp[3]) ? $temp[3] : $temp[4];
                if (!$nik) 
                continue;
            }

            //var_dump($temp); die;

            $id_kelurahan = $temp[0];

            $kelurahan = Kelurahan::where('id', $id_kelurahan)->first();

            //var_dump($kelurahan); die;

            if($kelurahan) {
                $id_kecamatan = $kelurahan->district_id;
            }
            else {
                $id_kecamatan = 0;
            }

            //echo $id_kecamatan; die;

            if (isset($temp[45])) {
                // $tgl = $temp[45];
                // $arr_tgl = explode("/", $tgl);
                // $tgl_lahir = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];
                $tgl_lahir = null;
            }
            else {
                $tgl_lahir = null;
            }

            if ($temp[8] != null && $temp[8] != '') {
                $pendidikan = SetupRtlh::where('parent_id', 160)
                    ->where('name', $temp[8])->value('id');
                $pendidikan = ($pendidikan) ? $pendidikan : 2654;
            }
            else {
                $pendidikan = 2654;
            }

            if ($temp[9] != null && $temp[9] != '') {
                $jenis_kel = SetupRtlh::where('parent_id', 4)
                    ->where('name', $temp[9])->value('id');
                $jenis_kel = ($jenis_kel) ? $jenis_kel : 2654;
            }
            else {
                $jenis_kel = 2654;
            }

            if ($temp[10] != null && $temp[10] != '') {
                $jenis_pek = SetupRtlh::where('parent_id', 5)
                    ->where('name', $temp[10])->value('id');
                $jenis_pek = ($jenis_pek) ? $jenis_pek : 2654;
            }
            else {
                $jenis_pek = 2654;
            }

            if ($temp[11] != null && $temp[11] != '') {
                $jml_penghasilan = SetupRtlh::where('parent_id', 6)
                    ->where('name', $temp[11])->value('id');
                $jml_penghasilan = ($jml_penghasilan) ? $jml_penghasilan : 2654;
            }
            else {
                $jml_penghasilan = 2654;
            }

            if ($temp[12] != null && $temp[12] != '') {
                $stts_rumah = SetupRtlh::where('parent_id', 8)
                    ->where('name', $temp[12])->value('id');
                $stts_rumah = ($stts_rumah) ? $stts_rumah : 2654;
            }
            else {
                $stts_rumah = 2654;
            }

            if ($temp[13] != null && $temp[11] != '') {
                $stts_rumah_lain = SetupRtlh::where('parent_id', 10)
                    ->where('name', $temp[13])->value('id');
                $stts_rumah_lain = ($stts_rumah_lain) ? $stts_rumah_lain : 2654;
            }
            else {
                $stts_rumah_lain = 2654;
            }

            if ($temp[14] != null && $temp[14] != '') {
                $stts_tanah = SetupRtlh::where('parent_id', 7)
                    ->where('name', $temp[14])->value('id');
                $stts_tanah = ($stts_tanah) ? $stts_tanah : 2654;
            }
            else {
                $stts_tanah = 2654;
            }

            if ($temp[15] != null && $temp[15] != '') {
                $stts_tanah_lain = SetupRtlh::where('parent_id', 9)
                    ->where('name', $temp[15])->value('id');
                $stts_tanah_lain = ($stts_tanah_lain) ? $stts_tanah_lain : 2654;
            }
            else {
                $stts_tanah_lain = 2654;
            }

            if ($temp[16] != null && $temp[16] != '') {
                $sumber_listrik = SetupRtlh::where('parent_id', 20)
                    ->where('name', $temp[16])->value('id');
                $sumber_listrik = ($sumber_listrik) ? $sumber_listrik : 2654;
            }
            else {
                $sumber_listrik = 2654;
            }

            if ($temp[18] != null && $temp[18] != '') {
                $kawasan_rumah = SetupRtlh::where('parent_id', 161)
                    ->where('name', $temp[18])->value('id');
                $kawasan_rumah = ($kawasan_rumah) ? $kawasan_rumah : 2654;
            }
            else {
                $kawasan_rumah = 2654;
            }

            if ($temp[20] != null && $temp[20] != '') {
                $pondasi = SetupRtlh::where('parent_id', 12)
                    ->where('name', $temp[20])->value('id');
                $pondasi = ($pondasi) ? $pondasi : 2654;
            }
            else {
                $pondasi = 2654;
            }

            if ($temp[21] != null && $temp[21] != '') {
                $kondisi_kolom = SetupRtlh::where('parent_id', 13)
                    ->where('name', $temp[21])->value('id');
                $kondisi_kolom = ($kondisi_kolom) ? $kondisi_kolom : 2654;
            }
            else {
                $kondisi_kolom = 2654;
            }

            if ($temp[22] != null && $temp[22] != '') {
                $kondisi_konstruksi = SetupRtlh::where('parent_id', 14)
                    ->where('name', $temp[22])->value('id');
                $kondisi_konstruksi = ($kondisi_konstruksi) ? $kondisi_konstruksi : 2654;
            }
            else {
                $kondisi_konstruksi = 2654;
            }

            if ($temp[23] != null && $temp[23] != '') {
                $kondisi_plafon = SetupRtlh::where('parent_id', 2677)
                    ->where('name', $temp[23])->value('id');
                $kondisi_plafon = ($kondisi_plafon) ? $kondisi_plafon : 2654;
            }
            else {
                $kondisi_plafon = 2654;
            }

            if ($temp[24] != null && $temp[24] != '') {
                $kondisi_balok = SetupRtlh::where('parent_id', 2678)
                    ->where('name', $temp[24])->value('id');
                $kondisi_balok = ($kondisi_balok) ? $kondisi_balok : 2654;
            }
            else {
                $kondisi_balok = 2654;
            }

            if ($temp[25] != null && $temp[25] != '') {
                $kondisi_sloof = SetupRtlh::where('parent_id', 2679)
                    ->where('name', $temp[25])->value('id');
                $kondisi_sloof = ($kondisi_sloof) ? $kondisi_sloof : 2654;
            }
            else {
                $kondisi_sloof = 2654;
            }

            if ($temp[26] != null && $temp[26] != '') {
                $jendela = SetupRtlh::where('parent_id', 15)
                    ->where('name', $temp[26])->value('id');
                $jendela = ($jendela) ? $jendela : 2654;
            }
            else {
                $jendela = 2654;
            }

            if ($temp[27] != null && $temp[27] != '') {
                $ventilasi = SetupRtlh::where('parent_id', 16)
                    ->where('name', $temp[27])->value('id');
                $ventilasi = ($ventilasi) ? $ventilasi : 2654;
            }
            else {
                $ventilasi = 2654;
            }

            if ($temp[28] != null && $temp[28] != '') {
                $material_lantai = SetupRtlh::where('parent_id', 25)
                    ->where('name', $temp[28])->value('id');
                $material_lantai = ($material_lantai) ? $material_lantai : 2654;
            }
            else {
                $material_lantai = 2654;
            }

            if ($temp[29] != null && $temp[29] != '') {
                $kondisi_lantai = SetupRtlh::where('parent_id', 26)
                    ->where('name', $temp[29])->value('id');
                $kondisi_lantai = ($kondisi_lantai) ? $kondisi_lantai : 2654;
            }
            else {
                $kondisi_lantai = 2654;
            }

            if ($temp[30] != null && $temp[30] != '') {
                $material_dinding = SetupRtlh::where('parent_id', 23)
                    ->where('name', $temp[30])->value('id');
                $material_dinding = ($material_dinding) ? $material_dinding : 2654;
            }
            else {
                $material_dinding = 2654;
            }

            if ($temp[31] != null && $temp[31] != '') {
                $kondisi_dinding = SetupRtlh::where('parent_id', 24)
                    ->where('name', $temp[31])->value('id');
                $kondisi_dinding = ($kondisi_dinding) ? $kondisi_dinding : 2654;
            }
            else {
                $kondisi_dinding = 2654;
            }

            if ($temp[32] != null && $temp[32] != '') {
                $material_atap = SetupRtlh::where('parent_id', 21)
                    ->where('name', $temp[32])->value('id');
                $material_atap = ($material_atap) ? $material_atap : 2654;
            }
            else {
                $material_atap = 2654;
            }

            if ($temp[33] != null && $temp[33] != '') {
                $kondisi_atap = SetupRtlh::where('parent_id', 22)
                    ->where('name', $temp[33])->value('id');
                $kondisi_atap = ($kondisi_atap) ? $kondisi_atap : 2654;
            }
            else {
                $kondisi_atap = 2654;
            }

            if ($temp[37] != null && $temp[37] != '') {
                $sumber_air_minum = SetupRtlh::where('parent_id', 19)
                    ->where('name', $temp[37])->value('id');
                $sumber_air_minum = ($sumber_air_minum) ? $sumber_air_minum : 2654;
            }
            else {
                $sumber_air_minum = 2654;
            }

            if ($temp[38] != null && $temp[38] != '') {
                $jarak_air_tpa = SetupRtlh::where('parent_id', 18)
                    ->where('name', $temp[38])->value('id');
                $jarak_air_tpa = ($jarak_air_tpa) ? $jarak_air_tpa : 2654;
            }
            else {
                $jarak_air_tpa = 2654;
            }

            if ($temp[39] != null && $temp[39] != '') {
                $stts_wc = SetupRtlh::where('parent_id', 17)
                    ->where('name', $temp[39])->value('id');
                $stts_wc = ($stts_wc) ? $stts_wc : 2654;
            }
            else {
                $stts_wc = 2654;
            }

            if ($temp[40] != null && $temp[40] != '') {
                $jenis_kloset = SetupRtlh::where('parent_id', 2675)
                    ->where('name', $temp[40])->value('id');
                $jenis_kloset = ($jenis_kloset) ? $jenis_kloset : 2654;
            }
            else {
                $jenis_kloset = 2654;
            }

            if ($temp[41] != null && $temp[41] != '') {
                $jenis_tpa = SetupRtlh::where('parent_id', 2676)
                    ->where('name', $temp[41])->value('id');
                $jenis_tpa = ($jenis_tpa) ? $jenis_tpa : 2654;
            }
            else {
                $jenis_tpa = 2654;
            }

            $luas1 = strtoupper($temp[34]);
            //$luas = explode("X",$luas);
            $pos  = strpos($luas1, 'X');
            if ($pos) 
            {
                $luas1 = explode("X",$luas1);
                $panjang1 = (int) $luas1[0];
                $lebar1 = (int) $luas1[1];
            }
            else {
                $panjang1 = 0;
                $lebar1 = 0;
            }

            $luas2 = strtoupper($temp[35]);
            //$luas = explode("X",$luas);
            $pos  = strpos($luas2, 'X');
            if ($pos) 
            {
                $luas2 = explode("X",$luas2);
                $panjang2 = (int) $luas2[0];
                $lebar2 = (int) $luas2[1];
            }
            else {
                $panjang2 = 0;
                $lebar2 = 0;
            }

            $data1 = [
                'id_user'        => Auth::user()->id,
                'nik'            => ($temp[3]) ? $temp[3] : $temp[4],
                'nama_lengkap'   => $temp[2],
                'id_kecamatan'   => $id_kecamatan,
                'id_kelurahan'   => $id_kelurahan,
                'alamat_lengkap' => $temp[6],
                'tgl_lahir'      => $tgl_lahir,
                'jenis_kelamin'  => $jenis_kel, //$temp[9],
                'jenis_pekerjaan'=> $jenis_pek, //$temp[10],
                'jml_penghasilan'=> $jml_penghasilan, //$temp[11],
                'pernah_dibantu' => 0,
                'bantuan_dari'   => '-',
                'umur'           => (int) $temp[7],
                'pendidikan'     => $pendidikan, //$temp[37],
                'kawasan_rumah'  => $kawasan_rumah, //$temp[36],
                'is_old'         => 0,
                'stts_verif'     => 1,
            ];

            //var_dump($data1); die;
                    
            $rtlh = Rtlh::create($data1);

            $data2 = [
                'id_rtlh'           => $rtlh->id,
                'jml_kk'            => (int) $temp[5],
                'jml_penghuni'      => (int) $temp[36],
                'panjang'           => $panjang1,
                'lebar'             => $lebar1,
                'stts_tanah'        => $stts_tanah,
                'stts_rumah'        => $stts_rumah,
                'stts_tanah_lain'   => $stts_tanah_lain,
                'stts_rumah_lain'   => $stts_rumah_lain,
                //'bukti_kepemilikan' => $request->input('bukti_kepemilikan'),
                'foto_bangunan'     => '',
                'koordinat_rumah'   => ($temp[43] != '') ? $temp[43].','.$temp[44] : '',
            ];

            //var_dump($data2); die;

            $rtlhKondisiRumah = RtlhKondisiRumah::create($data2);

            $data3 = [
                'id_rtlh'            => $rtlh->id,
                'pondasi'            => $pondasi,
                'kondisi_kolom'      => $kondisi_kolom,
                'kondisi_konstruksi' => $kondisi_konstruksi, //$kondisi_konstruksi,
                'jendela'            => $jendela,
                'ventilasi'          => $ventilasi,
                'stts_wc'            => $stts_wc, //$stts_wc,
                'jarak_air_tpa'      => $jarak_air_tpa,
                'sumber_air_minum'   => $sumber_air_minum,
                'sumber_listrik'     => $sumber_listrik,
                'panjang'            => $panjang2,
                'lebar'              => $lebar2,
                'material_atap'      => $material_atap,
                'kondisi_atap'       => $kondisi_atap,
                'material_dinding'   => $material_dinding,
                'kondisi_dinding'    => $kondisi_dinding,
                'material_lantai'    => $material_lantai,
                'kondisi_lantai'     => $kondisi_lantai,
                'jenis_kloset'       => $jenis_kloset,
                'jenis_tpa'          => $jenis_tpa,
                'kondisi_plafon'     => $kondisi_plafon,
                'kondisi_balok'      => $kondisi_balok,
                'kondisi_sloof'      => $kondisi_sloof,
            ];

            //var_dump($data3); die;

            $rtlhKelayakanRumah = RtlhKelayakanRumah::create($data3);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
