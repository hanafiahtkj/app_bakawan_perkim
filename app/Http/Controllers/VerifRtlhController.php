<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rtlh;
use App\Models\RtlhBukti;
use App\Models\RtlhKondisiRumah;
use App\Models\RtlhKelayakanRumah;
use App\Models\RtlhVerif;
use App\Models\RtlhVerifFiles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\SetupRtlh;
use App\Models\SetupVerif;
use App\Models\SetupVerifField;
use App\Models\SetupVerifFieldValue;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use DB;
use App\Models\User;
use App\Models\PushNotification;

class VerifRtlhController extends Controller
{
    public function show($id)
    {
        $rtlh = DB::table('rtlh')
            ->select('rtlh.*', DB::raw("DATE_FORMAT(rtlh.tgl_lahir, '%d/%m/%Y') as tgl_lahir2"))
            ->where('id', $id)->first();

        $rtlhBukti = DB::table('rtlh_bukti')
            ->where('id_rtlh', $id)->pluck('id_setup_bukti');

        $kondisiRumah = DB::table('rtlh_kondisi_rumah')
            ->where('id_rtlh', $id)->first();

        $kelayakanRumah = DB::table('rtlh_kelayakan_rumah')
            ->where('id_rtlh', $id)->first();

        $uploads = SetupVerifField::where('id_setup', 1)->get();

        $dataVerif = SetupVerifField::where('id_setup', 2)->get();

        $data = [
            'kecamatan'         => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
            'jenis_kel'         => SetupRtlh::where('parent_id', 4)->get(),
            'jenis_pek'         => SetupRtlh::where('parent_id', 5)->get(),
            'jml_penghasilan'   => SetupRtlh::where('parent_id', 6)->get(),
            'stts_tanah'        => SetupRtlh::where('parent_id', 7)->get(),
            'stts_rumah'        => SetupRtlh::where('parent_id', 8)->get(),
            'stts_tanah_lain'   => SetupRtlh::where('parent_id', 9)->get(),
            'stts_rumah_lain'   => SetupRtlh::where('parent_id', 10)->get(),
            'bukti_kepemilikan' => SetupRtlh::where('parent_id', 11)->get(),
            'pondasi'           => SetupRtlh::where('parent_id', 12)->get(),
            'kondisi_kolom'     => SetupRtlh::where('parent_id', 13)->get(),
            'kondisi_konstruksi'=> SetupRtlh::where('parent_id', 14)->get(),
            'jendela'           => SetupRtlh::where('parent_id', 15)->get(),
            'ventilasi'         => SetupRtlh::where('parent_id', 16)->get(),
            'stts_wc'           => SetupRtlh::where('parent_id', 17)->get(),
            'jarak_air_tpa'     => SetupRtlh::where('parent_id', 18)->get(),
            'sumber_air_minum'  => SetupRtlh::where('parent_id', 19)->get(),
            'sumber_listrik'    => SetupRtlh::where('parent_id', 20)->get(),
            'material_atap'     => SetupRtlh::where('parent_id', 21)->get(),
            'kondisi_atap'      => SetupRtlh::where('parent_id', 22)->get(),
            'material_dinding'  => SetupRtlh::where('parent_id', 23)->get(),
            'kondisi_dinding'   => SetupRtlh::where('parent_id', 24)->get(),
            'material_lantai'   => SetupRtlh::where('parent_id', 25)->get(),
            'kondisi_lantai'    => SetupRtlh::where('parent_id', 26)->get(),
            'pendidikan'        => SetupRtlh::where('parent_id', 160)->get(),
            'kawasan_rumah'     => SetupRtlh::where('parent_id', 161)->get(),
            'jenis_kloset'      => SetupRtlh::where('parent_id', 2675)->get(),
            'jenis_tpa'         => SetupRtlh::where('parent_id', 2676)->get(),
            'kondisi_plafon'    => SetupRtlh::where('parent_id', 2677)->get(),
            'kondisi_balok'     => SetupRtlh::where('parent_id', 2678)->get(),
            'kondisi_sloof'     => SetupRtlh::where('parent_id', 2679)->get(),
            'fungsi_ruang'      => SetupRtlh::where('parent_id', 2752)->get(),
            'rtlh'              => $rtlh,
            'rtlhBukti'         => $rtlhBukti,
            'kondisiRumah'      => $kondisiRumah,
            'kelayakanRumah'    => $kelayakanRumah,
            'uploads'           => $uploads,
            'dataVerif'         => $dataVerif,
        ];

        return view('verif-rtlh', $data);
    }

    public function store(Request $request)
    {
        $validasi = $this->_validasi();

        if ($id = $request->input('id_rtlh')) {
            $validasi['nik'] = 'required|unique:rtlh,nik,'.$id;
            $rtlh = Rtlh::find($id);
            $kondisiRumah = DB::table('rtlh_kondisi_rumah')->where('id_rtlh', $id)->first();
            if ($kondisiRumah->foto_bangunan != null) {
                $validasi['foto_bangunan'] = 'mimes:jpg,bmp,png';
            }
        }

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        try{
            DB::beginTransaction();

            $tgl = $request->input('tgl_lahir');
            $arr_tgl = explode("/", $tgl);
            $tgl_lahir = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];

            $id_rtlh = $request->input('id_rtlh');
            $rtlh->update([
                //'id_user'        => Auth::user()->id,
                'nik'            => $request->input('nik'),
                'no_kk'          => $request->input('no_kk'),
                'nama_lengkap'   => $request->input('nama_lengkap'),
                'id_kecamatan'   => $request->input('id_kecamatan'),
                'id_kelurahan'   => $request->input('id_kelurahan'),
                'alamat_lengkap' => $request->input('alamat_lengkap'),
                'tgl_lahir'      => $tgl_lahir,
                'jenis_kelamin'  => $request->input('jenis_kelamin'),
                'jenis_pekerjaan'=> $request->input('jenis_pekerjaan'),
                'jml_penghasilan'=> $request->input('jml_penghasilan'),
                'pernah_dibantu' => $request->input('pernah_dibantu'),
                'bantuan_dari'   => $request->input('bantuan_dari'),
                'pendidikan'     => $request->input('pendidikan'),
                'kawasan_rumah'  => $request->input('kawasan_rumah'),
                'stts_verif'     => $request->input('stts_verif'),
            ]);

            $reqKondisi = [
                'id_rtlh'           => $id_rtlh,
                'jml_kk'            => str_replace(",", ".", $request->input('jml_kk')),
                'jml_penghuni'      => str_replace(",", ".", $request->input('jml_penghuni')),
                'panjang'           => str_replace(",", ".", $request->input('panjang1')),
                'lebar'             => str_replace(",", ".", $request->input('lebar1')),
                'stts_tanah'        => $request->input('stts_tanah'),
                'stts_rumah'        => $request->input('stts_rumah'),
                'stts_tanah_lain'   => $request->input('stts_tanah_lain'),
                'stts_rumah_lain'   => $request->input('stts_rumah_lain'),
                'koordinat_rumah'   => $request->input('koordinat_rumah'),
            ];

            // Upload foto bangunan
            $upload = $request->file('foto_bangunan');
            if ($upload) {
                $upload_path = 'uploads/rtlh/'.$rtlh->id;
                $filename = time().'_'.$upload->getClientOriginalName();
                $upload->move($upload_path, $filename);
                $reqKondisi['foto_bangunan'] = $upload_path.'/'.$filename;
            }

            $rtlhKondisiRumah = RtlhKondisiRumah::where('id_rtlh', $id_rtlh);
            $rtlhKondisiRumah->update($reqKondisi);

            DB::table('rtlh_bukti')->where('id_rtlh', $id_rtlh)->delete();
            if ($bukti = $request->input('bukti_kepemilikan')) {
                foreach ($bukti as $key => $value) {
                    $rtlhBukti = RtlhBukti::create([
                        'id_rtlh'           => $id_rtlh,
                        'id_setup_bukti'    => $value
                    ]);
                }
            }

            $rtlhKelayakanRumah = RtlhKelayakanRumah::where('id_rtlh', $id_rtlh);
            $rtlhKelayakanRumah->update([
                'id_rtlh'            => $id_rtlh,
                'pondasi'            => $request->input('pondasi'),
                'kondisi_kolom'      => $request->input('kondisi_kolom'),
                'kondisi_konstruksi' => $request->input('kondisi_konstruksi'),
                'jendela'            => $request->input('jendela'),
                'ventilasi'          => $request->input('ventilasi'),
                'stts_wc'            => $request->input('stts_wc'),
                'jarak_air_tpa'      => $request->input('jarak_air_tpa'),
                'sumber_air_minum'   => $request->input('sumber_air_minum'),
                'sumber_listrik'     => $request->input('sumber_listrik'),
                'panjang'            => str_replace(",", ".", $request->input('panjang2')),
                'lebar'              => str_replace(",", ".", $request->input('lebar2')),
                'material_atap'      => $request->input('material_atap'),
                'kondisi_atap'       => $request->input('kondisi_atap'),
                'material_dinding'   => $request->input('material_dinding'),
                'kondisi_dinding'    => $request->input('kondisi_dinding'),
                'material_lantai'    => $request->input('material_lantai'),
                'kondisi_lantai'     => $request->input('kondisi_lantai'),
                'jenis_kloset'       => $request->input('jenis_kloset'),
                'jenis_tpa'          => $request->input('jenis_tpa'),
                'kondisi_plafon'     => $request->input('kondisi_plafon'),
                'kondisi_balok'      => $request->input('kondisi_balok'),
                'kondisi_sloof'      => $request->input('kondisi_sloof'),
                'fungsi_ruang'       => $request->input('fungsi_ruang'),
            ]);

            DB::table('rtlh_verif')->where('id_rtlh', $id_rtlh)->delete();
            $rtlhVerif = RtlhVerif::create([
                'id_rtlh'               => $id_rtlh,
                'id_user'               => Auth::user()->id,
                'nik'                   => $request->input('nik'),
                'nama_lengkap'          => $request->input('nama_lengkap'),
                'alamat_lengkap'        => $request->input('alamat_lengkap'),
                'jenis_pekerjaan'       => $request->input('jenis_pekerjaan'),
                'jml_penghasilan'       => $request->input('jml_penghasilan'),
                'koordinat_rumah'       => $request->input('koordinat_rumah'),
                'custom_field'          => $request->input('custom_field'),
                'catatan'               => $request->input('catatan'),
                'stts_verif'            => $request->input('stts_verif'),
            ]);

            DB::table('rtlh_verif_files')->where('id_rtlh', $id_rtlh)->delete();
            $uploads = SetupVerifField::where('id_setup', 1)->get();
            foreach ($uploads as $key => $value)
            {
                $upload = $request->file('uploads_'.$value->id);
                if ($upload) {
                    $upload_path = 'uploads/rtlh/'.$id_rtlh;
                    $filename = 'id_setup_'.$value->id.'_'.$upload->getClientOriginalName();
                    $upload->move($upload_path, $filename);

                    $rtlhFiles = RtlhVerifFiles::create([
                        'id_rtlh'       => $rtlh->id,
                        'id_rtlh_verif' => $rtlhVerif->id,
                        'id_setup'      => $value->id,
                        'files'         => $upload_path.'/'.$filename,
                    ]);
                }
            }

            $this->_notifyGeneral(
                'RTLH BARU',
                'RTLH dengan No Nik : '.$rtlh->nik.' sudah diverifikasi',
                $rtlh->id_user
            );

            $this->_notifyAdmin(
                'RTLH BARU',
                'RTLH dengan No Nik : '.$rtlh->nik.' diverifikasi oleh '. Auth::user()->name
            );

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

    public function validasi(Request $request)
    {
        $type = $request->input('type');
        $validasi = $this->_validasi($type);

        // jika update
        if ($id = $request->input('id_rtlh')) {
            // $validasi['nik'] = 'required|unique:rtlh,nik,'.$id;
            $validasi['nik'] = 'required';
            $rtlh = Rtlh::find($id);
            $kondisiRumah = DB::table('rtlh_kondisi_rumah')->where('id_rtlh', $id)->first();
            if ($kondisiRumah->foto_bangunan != null) {
                $validasi['foto_bangunan'] = 'mimes:jpg,bmp,png';
            }
        }

        $validator = Validator::make($request->all(), $validasi);
        return response()->json([
            'status' => !$validator->fails(),
            'errors' => $validator->errors()
        ]);
    }

    public function _validasi($type = 'all')
    {
        $rule_1 = [
            'nik'            => 'required|unique:rtlh|min:16|max:16',
            //'no_kk'          => 'min:16',
            'nama_lengkap'   => 'required',
            'id_kecamatan'   => 'required',
            'id_kelurahan'   => 'required',
            'alamat_lengkap' => 'required',
            'tgl_lahir'      => 'required',
            'jenis_kelamin'  => 'required',
            'jenis_pekerjaan'=> 'required',
            //'jml_penghasilan'=> 'required',
            'pernah_dibantu' => 'required',
            'bantuan_dari'   => 'required',
            'pendidikan'     => 'required',
        ];

        $rule_2 = [
            'jml_kk'            => 'required',
            'jml_penghuni'      => 'required',
            'panjang1'          => 'required',
            'lebar1'            => 'required',
            'stts_tanah'        => 'required',
            'stts_rumah'        => 'required',
            // 'stts_tanah_lain'   => 'required',
            'stts_rumah_lain'   => 'required',
            // 'bukti_kepemilikan' => 'required',
            'foto_bangunan'     => 'required|mimes:jpg,bmp,png|max:2048',
            'koordinat_rumah'   => 'required',
        ];

        $rule_3 = [
            'pondasi'           => 'required',
            'kondisi_kolom'     => 'required',
            'kondisi_konstruksi'=> 'required',
            'jendela'           => 'required',
            'ventilasi'         => 'required',
            'stts_wc'           => 'required',
            'jarak_air_tpa'     => 'required',
            'sumber_air_minum'  => 'required',
            'sumber_listrik'    => 'required',
            // 'panjang2'          => 'required',
            // 'lebar2'            => 'required',
            'material_atap'     => 'required',
            'kondisi_atap'      => 'required',
            'material_dinding'  => 'required',
            'kondisi_dinding'   => 'required',
            'material_lantai'   => 'required',
            'kondisi_lantai'    => 'required',
            // 'jenis_kloset'      => 'required',
            // 'jenis_tpa'         => 'required',
            'kondisi_plafon'    => 'required',
            'kondisi_balok'     => 'required',
            'kondisi_sloof'     => 'required',
            // 'kawasan_rumah'     => 'required',
            // 'fungsi_ruang'      => 'required',
        ];

        $rule_4 = [];
        $uploads = SetupVerifField::where('id_setup', 1)->get();
        foreach ($uploads as $key => $value)
        {
            $rule_4['uploads_'.$value->id] = 'mimes:pdf,jpg,bmp,png|max:2048';
        }

        $rule_5 = [
            'stts_verif'            => 'required',
        ];

        switch ($type) {
            case 'identitas':
                $validasi = $rule_1;
                break;
            case 'kondisi':
                $validasi = $rule_2;
                break;
            case 'data':
                $validasi = $rule_4;
                break;
            default:
                $validasi = array_merge($rule_1, $rule_2, $rule_3, $rule_4, $rule_5);
        }

        return $validasi;
    }

    public function batal($id)
    {
        $rtlh = Rtlh::find($id);
        $rtlh->update([
            'stts_verif' => null,
            'stts_realisasi' => null,
        ]);
        DB::table('rtlh_verif')->where('id_rtlh', $id)->delete();
        DB::table('rtlh_verif_files')->where('id_rtlh', $id)->delete();

        $this->_notifyGeneral(
            'BATAL VERIFIKASI RTLH',
            'Verifikasi RTLH dengan No Nik : '.$rtlh->nik.' dibatalkan',
            $rtlh->id_user
        );

        $this->_notifyAdmin(
            'BATAL VERIFIKASI RTLH',
            'Verifikasi RTLH dengan No Nik : '.$rtlh->nik.' dibatalkan oleh '. Auth::user()->name
        );

        return response()->json([
            'status' => true,
        ]);
    }

    function _notifyGeneral($title, $body, $id_user)
    {
        $users = User::where('id', $id_user)
            ->pluck('fcm_token', 'id')->toArray();

        $recipients = array();
        foreach ($users as $key => $value)
        {
            $recipients[]   = $value;
            $notif = new PushNotification();
            $notif->id_user = $key;
            $notif->title   = $title;
            $notif->body    = $body;
            $notif->save();
        }

        $respons = fcm()
            ->to(array_filter($recipients))
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'title' => $title,
                'body'  => $body,
            ])
            ->notification([
                'title' => $title,
                'body'  => $body,
            ])
            ->send();
    }

    function _notifyAdmin($title, $body)
    {
        $users = User::role(['Admin', 'TFL'])
            ->pluck('fcm_token', 'id')->toArray();

        $recipients = array();
        foreach ($users as $key => $value)
        {
            $recipients[]   = $value;
            $notif = new PushNotification();
            $notif->id_user = $key;
            $notif->title   = $title;
            $notif->body    = $body;
            $notif->save();
        }

        $respons = fcm()
            ->to(array_filter($recipients))
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'title' => $title,
                'body'  => $body,
            ])
            ->notification([
                'title' => $title,
                'body'  => $body,
            ])
            ->send();
    }
}
