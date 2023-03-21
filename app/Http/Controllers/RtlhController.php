<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetupRtlh;
use App\Models\Rtlh;
use App\Models\RtlhCatatan;
use App\Models\RtlhBukti;
use App\Models\RtlhKondisiRumah;
use App\Models\RtlhKelayakanRumah;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\PushNotification;
use App\Exports\RtlhExport;
use Maatwebsite\Excel\Facades\Excel;

class RtlhController extends Controller
{
    public function create()
    {
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
            'profile'           => Auth::user(),
        ];
        return view('create-rtlh', $data);
    }

    public function store(Request $request)
    {
        $validasi = $this->_validasi();
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

            $dataRtlh = [
                'id_user'        => Auth::user()->id,
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
                'is_old'         => $request->input('is_old'),
            ];

            // jika Konsultan tidak perlu diverifikasi
            if (Auth::user()->hasRole(['Konsultan'])) {
                $dataRtlh['stts_verif'] = 1;
            }

            $rtlh = Rtlh::create($dataRtlh);

            // Upload foto bangunan
            $foto_bangunan = '';
            $upload = $request->file('foto_bangunan');
            if($upload) {
                $upload_path = 'uploads/rtlh/'.$rtlh->id;
                $filename = time().'_'.$upload->getClientOriginalName();
                $upload->move($upload_path, $filename);
                $foto_bangunan = $upload_path.'/'.$filename;
            }

            $rtlhKondisiRumah = RtlhKondisiRumah::create([
                'id_rtlh'           => $rtlh->id,
                'jml_kk'            => str_replace(",", ".", $request->input('jml_kk')),
                'jml_penghuni'      => str_replace(",", ".", $request->input('jml_penghuni')),
                'panjang'           => (float) str_replace(",", ".", $request->input('panjang1')),
                'lebar'             => (float) str_replace(",", ".", $request->input('lebar1')),
                'stts_tanah'        => $request->input('stts_tanah'),
                'stts_rumah'        => $request->input('stts_rumah'),
                'stts_tanah_lain'   => $request->input('stts_tanah_lain'),
                'stts_rumah_lain'   => $request->input('stts_rumah_lain'),
                //'bukti_kepemilikan' => $request->input('bukti_kepemilikan'),
                'foto_bangunan'     => $foto_bangunan,
                'koordinat_rumah'   => $request->input('koordinat_rumah'),
            ]);

            if ($bukti = $request->input('bukti_kepemilikan')) {
                foreach ($bukti as $key => $value) {
                    $rtlhBukti = RtlhBukti::create([
                        'id_rtlh'           => $rtlh->id,
                        'id_setup_bukti'    => $value
                    ]);
                }
            }

            $rtlhKelayakanRumah = RtlhKelayakanRumah::create([
                'id_rtlh'            => $rtlh->id,
                'pondasi'            => $request->input('pondasi'),
                'kondisi_kolom'      => $request->input('kondisi_kolom'),
                'kondisi_konstruksi' => $request->input('kondisi_konstruksi'),
                'jendela'            => $request->input('jendela'),
                'ventilasi'          => $request->input('ventilasi'),
                'stts_wc'            => $request->input('stts_wc'),
                'jarak_air_tpa'      => $request->input('jarak_air_tpa'),
                'sumber_air_minum'   => $request->input('sumber_air_minum'),
                'sumber_listrik'     => $request->input('sumber_listrik'),
                'panjang'            => (float) str_replace(",", ".", $request->input('panjang2')),
                'lebar'              => (float) str_replace(",", ".", $request->input('lebar2')),
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

            $this->_notify(
                'RTLH BARU',
                'RTLH dengan No Nik : '.$request->input('nik').' ditambahkan oleh '. Auth::user()->name
            );

            DB::commit();

        }catch(\Exception $e){
            //dd($e);
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
        if (Auth::user()->hasRole(['Konsultan'])) {

            $rule_1 = [
                'nik'            => 'required|unique:rtlh|min:16|max:16',
                //'no_kk'          => 'required|min:16',
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
                'foto_bangunan'     => 'mimes:jpg,bmp,png',
                // 'koordinat_rumah'   => 'required',
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
                // 'kondisi_plafon'    => 'required',
                // 'kondisi_balok'     => 'required',
                // 'kondisi_sloof'     => 'required',
                // 'kawasan_rumah'     => 'required',
                // 'fungsi_ruang'      => 'required',
            ];

        } else if (Auth::user()->hasRole(['TFL'])) {
            $rule_1 = [
                'nik'            => 'required|unique:rtlh|min:16|max:16',
                //'no_kk'          => 'required|min:16',
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
                'foto_bangunan'     => 'required|mimes:jpg,bmp,png',
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

        } else {

            $rule_1 = [
                'nik'            => 'required|unique:rtlh|min:16|max:16',
                'no_kk'          => 'required|min:16',
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
                // 'panjang1'          => 'required',
                // 'lebar1'            => 'required',
                // 'stts_tanah'        => 'required',
                // 'stts_rumah'        => 'required',
                // 'stts_tanah_lain'   => 'required',
                // 'stts_rumah_lain'   => 'required',
                // 'bukti_kepemilikan' => 'required',
                'foto_bangunan'     => 'mimes:jpg,bmp,png|max:2048',
                // 'koordinat_rumah'   => 'required',
            ];

            $rule_3 = [
                // 'pondasi'           => 'required',
                // 'kondisi_kolom'     => 'required',
                // 'kondisi_konstruksi'=> 'required',
                // 'jendela'           => 'required',
                // 'ventilasi'         => 'required',
                // 'stts_wc'           => 'required',
                // 'jarak_air_tpa'     => 'required',
                // 'sumber_air_minum'  => 'required',
                // 'sumber_listrik'    => 'required',
                // 'panjang2'          => 'required',
                // 'lebar2'            => 'required',
                // 'material_atap'     => 'required',
                // 'kondisi_atap'      => 'required',
                // 'material_dinding'  => 'required',
                // 'kondisi_dinding'   => 'required',
                // 'material_lantai'   => 'required',
                // 'kondisi_lantai'    => 'required',
                // 'jenis_kloset'      => 'required',
                // 'jenis_tpa'         => 'required',
                // 'kondisi_plafon'    => 'required',
                // 'kondisi_balok'     => 'required',
                // 'kondisi_sloof'     => 'required',
                // 'kawasan_rumah'     => 'required',
                // 'fungsi_ruang'      => 'required',
            ];
        }

        switch ($type) {
            case 'identitas':
                $validasi = $rule_1;
                break;
            case 'kondisi':
                $validasi = $rule_2;
                break;
            default:
                $validasi = array_merge($rule_1, $rule_2, $rule_3);
        }

        return $validasi;
    }

    public function show($id)
    {
        $rtlh = DB::table('rtlh')
            ->select(
                'rtlh.*',
                DB::raw("DATE_FORMAT(rtlh.tgl_lahir, '%d/%m/%Y') as tgl_lahir2")
            )
            ->where('rtlh.id', $id)->first();

        $rtlhBukti = DB::table('rtlh_bukti')
            ->where('id_rtlh', $id)->pluck('id_setup_bukti');

        $kondisiRumah = DB::table('rtlh_kondisi_rumah')
            ->where('id_rtlh', $id)->first();

        $kelayakanRumah = DB::table('rtlh_kelayakan_rumah')
            ->where('id_rtlh', $id)->first();

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
            'rtlh'              => $rtlh,
            'rtlhBukti'         => $rtlhBukti,
            'kondisiRumah'      => $kondisiRumah,
            'kelayakanRumah'    => $kelayakanRumah,
            'pendidikan'        => SetupRtlh::where('parent_id', 160)->get(),
            'kawasan_rumah'     => SetupRtlh::where('parent_id', 161)->get(),
            'jenis_kloset'      => SetupRtlh::where('parent_id', 2675)->get(),
            'jenis_tpa'         => SetupRtlh::where('parent_id', 2676)->get(),
            'kondisi_plafon'    => SetupRtlh::where('parent_id', 2677)->get(),
            'kondisi_balok'     => SetupRtlh::where('parent_id', 2678)->get(),
            'kondisi_sloof'     => SetupRtlh::where('parent_id', 2679)->get(),
            'fungsi_ruang'      => SetupRtlh::where('parent_id', 2752)->get(),
            'profile'           => Auth::user(),
        ];

        return view('view-rtlh', $data);
    }

    public function edit($id)
    {
        $rtlh = DB::table('rtlh')
            ->select(
                'rtlh.*',
                DB::raw("DATE_FORMAT(rtlh.tgl_lahir, '%d/%m/%Y') as tgl_lahir2")
            )
            ->where('rtlh.id', $id)->first();

        $rtlhBukti = DB::table('rtlh_bukti')
            ->where('id_rtlh', $id)->pluck('id_setup_bukti');

        $kondisiRumah = DB::table('rtlh_kondisi_rumah')
            ->where('id_rtlh', $id)->first();

        $kelayakanRumah = DB::table('rtlh_kelayakan_rumah')
            ->where('id_rtlh', $id)->first();

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
            'rtlh'              => $rtlh,
            'rtlhBukti'         => $rtlhBukti,
            'kondisiRumah'      => $kondisiRumah,
            'kelayakanRumah'    => $kelayakanRumah,
            'pendidikan'        => SetupRtlh::where('parent_id', 160)->get(),
            'kawasan_rumah'     => SetupRtlh::where('parent_id', 161)->get(),
            'jenis_kloset'      => SetupRtlh::where('parent_id', 2675)->get(),
            'jenis_tpa'         => SetupRtlh::where('parent_id', 2676)->get(),
            'kondisi_plafon'    => SetupRtlh::where('parent_id', 2677)->get(),
            'kondisi_balok'     => SetupRtlh::where('parent_id', 2678)->get(),
            'kondisi_sloof'     => SetupRtlh::where('parent_id', 2679)->get(),
            'fungsi_ruang'      => SetupRtlh::where('parent_id', 2752)->get(),
            'profile'           => Auth::user(),
        ];

        // stts = menunggu or perlu perbaikan
        if (Auth::user()->hasRole('TFL')) {
            if ($rtlh->stts_verif == null || $rtlh->stts_verif == 3) {
                return view('edit-rtlh', $data);
            }
            else {
                return view('view-rtlh', $data);
            }
        }
        else {
            if ($rtlh->stts_verif == null || $rtlh->stts_verif == 3) {
                return view('edit-rtlh', $data);
            }
            else {
                return view('view-rtlh', $data);
            }
        }
    }

    public function update(Request $request)
    {
        $validasi = $this->_validasi();

        if ($id = $request->input('id_rtlh')) {
            $validasi['nik'] = 'required|unique:rtlh,nik,'.$id;
            $validasi['foto_bangunan'] = '';
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

            $id  = $request->input('id_rtlh');
            $tgl = $request->input('tgl_lahir');
            $arr_tgl = explode("/", $tgl);
            $tgl_lahir = $arr_tgl[2].'-'.$arr_tgl[1].'-'.$arr_tgl[0];

            $rtlh = Rtlh::find($id);
            $rtlh->update([
                'id_user'        => Auth::user()->id,
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
                'stts_verif'     => null,
            ]);

            $reqKondisi = [
                'id_rtlh'           => $id,
                'jml_kk'            => str_replace(",", ".", $request->input('jml_kk')),
                'jml_penghuni'      => str_replace(",", ".", $request->input('jml_penghuni')),
                'panjang'           => (float) str_replace(",", ".", $request->input('panjang1')),
                'lebar'             => (float) str_replace(",", ".", $request->input('lebar1')),
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

            $rtlhKondisiRumah = RtlhKondisiRumah::where('id_rtlh', $id);
            $rtlhKondisiRumah->update($reqKondisi);

            DB::table('rtlh_bukti')->where('id_rtlh', $id)->delete();
            if ($bukti = $request->input('bukti_kepemilikan')) {
                foreach ($bukti as $key => $value) {
                    $rtlhBukti = RtlhBukti::create([
                        'id_rtlh'           => $id,
                        'id_setup_bukti'    => $value
                    ]);
                }
            }

            $rtlhKelayakanRumah = RtlhKelayakanRumah::where('id_rtlh', $id);
            $rtlhKelayakanRumah->update([
                'id_rtlh'            => $id,
                'pondasi'            => $request->input('pondasi'),
                'kondisi_kolom'      => $request->input('kondisi_kolom'),
                'kondisi_konstruksi' => $request->input('kondisi_konstruksi'),
                'jendela'            => $request->input('jendela'),
                'ventilasi'          => $request->input('ventilasi'),
                'stts_wc'            => $request->input('stts_wc'),
                'jarak_air_tpa'      => $request->input('jarak_air_tpa'),
                'sumber_air_minum'   => $request->input('sumber_air_minum'),
                'sumber_listrik'     => $request->input('sumber_listrik'),
                'panjang'            => (float) str_replace(",", ".", $request->input('panjang2')),
                'lebar'              => (float) str_replace(",", ".", $request->input('lebar2')),
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

            $this->_notify(
                'EDIT RTLH',
                'RTLH dengan No Nik : '.$request->input('nik').' diedit oleh '. Auth::user()->name
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

    public function getKelurahan($id)
    {
        $kelurahan = [];
        if ($id) {
            $kelurahan = Kelurahan::where('district_id', $id)
                ->pluck('name', 'id');
        }
        return response()->json(['data' => $kelurahan]);
    }

    public function getDataTables(Request $request)
    {
        $query = DB::table('rtlh')
            ->join('rtlh_kondisi_rumah', 'rtlh_kondisi_rumah.id_rtlh', '=', 'rtlh.id')
            ->join('rtlh_kelayakan_rumah', 'rtlh_kelayakan_rumah.id_rtlh', '=', 'rtlh.id')
            ->leftJoin('indonesia_districts as kec', 'kec.id', '=', 'rtlh.id_kecamatan')
            ->leftJoin('indonesia_villages as kel', 'kel.id', '=', 'rtlh.id_kelurahan')
            ->leftJoin('stts_verif', 'rtlh.stts_verif', '=', 'stts_verif.id')
            ->leftJoin('stts_realisasi', 'rtlh.stts_realisasi', '=', 'stts_realisasi.id')
            ->leftJoin('rtlh_verif', 'rtlh.id', '=', 'rtlh_verif.id_rtlh')
            ->select('rtlh.*',
                'kec.name as name_kecamatan',
                'kel.name as name_kelurahan',
                DB::raw("DATE_FORMAT(rtlh.created_at, '%d-%m-%Y') as tanggal"),
                "stts_verif.name as ket_verif",
                'stts_realisasi.name as ket_realisasi',
                'rtlh_verif.catatan'
            );

        $user = Auth::user();
        if ($user->hasRole('General')) {
            $query->where('rtlh.id_user', $user->id);
        }
        else if ($user->hasRole('Konsultan')) {
            $query->where('rtlh.id_user', $user->id);
        }

        // having count search
        $stts = $request->get('stts_verif');
        if ($stts) {
            if ( $stts != 'all' ) {
                $query->where('rtlh.stts_verif', $stts);
            }
        }
        else {
            $query->where('rtlh.stts_verif', null);
        }

        if ($id_kecamatan = $request->get('id_kecamatan')) {
            $query->where('rtlh.id_kecamatan', $id_kecamatan);
        }

        if ($id_kelurahan = $request->get('id_kelurahan')) {
            $query->where('rtlh.id_kelurahan', $id_kelurahan);
        }

        if ($jml_kk = $request->get('jml_kk')) {
            $query->where('rtlh_kondisi_rumah.jml_kk', $jml_kk);
        }

        return DataTables::of($query)->toJson();
    }

    public function realisasi(Request $request)
    {
        $id   = $request->input('id_rtlh');
        $stts = $request->input('stts_realisasi');
        $rtlh = Rtlh::find($id);
        $rtlh->update([
            'stts_realisasi' => $stts,
        ]);
        return response()->json([
            'status' => true,
        ]);
    }

    public function bynik($nik)
    {
        $rtlh = DB::table('rtlh')
            ->where('nik', $nik)->first();

        return response()->json([
            'status' => ($rtlh) ? true : false,
            'rtlh'   => $rtlh,
        ]);
    }

    public function catatan(Request $request)
    {
        try{
            DB::beginTransaction();

            $id  = $request->input('id_rtlh');

            $rtlh = RtlhCatatan::create([
                'id_user'   => Auth::user()->id,
                'id_rtlh'   => $request->input('id_rtlh'),
                'catatan'   => $request->input('catatan'),
            ]);

            $this->_notify(
                'CATATAN RTLH',
                'RTLH dengan No Nik : '.$request->input('nik').' diberi catatan oleh '. Auth::user()->name
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

    function _notify($title, $body)
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

        //dd($respons); die;
    }

    public function export(Request $request)
	{
        $type= '_export_'.$request->get('type');
        return $this->{$type}($request);
    }

    function _export_excel($request)
	{
        return Excel::download(new RtlhExport($request), 'rtlh.xlsx');
    }

    function _export_json($request)
	{
        $bukti =
            "(SELECT GROUP_CONCAT(setup_rtlh.name) as list_name, id_rtlh
            FROM rtlh_bukti join setup_rtlh on setup_rtlh.id = rtlh_bukti.id_setup_bukti
            GROUP BY rtlh_bukti.id_rtlh) AS setup_bukti";

        $query = DB::table('rtlh')
            ->join('rtlh_kondisi_rumah as kondisi', 'kondisi.id_rtlh', '=', 'rtlh.id')
            ->join('rtlh_kelayakan_rumah as kelayakan', 'kelayakan.id_rtlh', '=', 'rtlh.id')
            ->leftJoin('setup_rtlh as setup1', 'setup1.id', '=', 'rtlh.jenis_kelamin')
            ->leftJoin('setup_rtlh as setup2', 'setup2.id', '=', 'rtlh.jenis_pekerjaan')
            ->leftJoin('setup_rtlh as setup3', 'setup3.id', '=', 'rtlh.jml_penghasilan')
            ->leftJoin('setup_rtlh as setup4', 'setup4.id', '=', 'kondisi.stts_tanah')
            ->leftJoin('setup_rtlh as setup5', 'setup5.id', '=', 'kondisi.stts_rumah')
            ->leftJoin('setup_rtlh as setup6', 'setup6.id', '=', 'kondisi.stts_tanah_lain')
            ->leftJoin('setup_rtlh as setup7', 'setup7.id', '=', 'kondisi.stts_rumah_lain')
            ->leftJoin('setup_rtlh as setup8', 'setup8.id', '=', 'kelayakan.pondasi')
            ->leftJoin('setup_rtlh as setup9', 'setup9.id', '=', 'kelayakan.kondisi_kolom')
            ->leftJoin('setup_rtlh as setup10', 'setup10.id', '=', 'kelayakan.kondisi_konstruksi')
            ->leftJoin('setup_rtlh as setup11', 'setup11.id', '=', 'kelayakan.jendela')
            ->leftJoin('setup_rtlh as setup12', 'setup12.id', '=', 'kelayakan.ventilasi')
            ->leftJoin('setup_rtlh as setup13', 'setup13.id', '=', 'kelayakan.stts_wc')
            ->leftJoin('setup_rtlh as setup14', 'setup14.id', '=', 'kelayakan.jarak_air_tpa')
            ->leftJoin('setup_rtlh as setup15', 'setup15.id', '=', 'kelayakan.sumber_air_minum')
            ->leftJoin('setup_rtlh as setup16', 'setup16.id', '=', 'kelayakan.sumber_listrik')
            ->leftJoin('setup_rtlh as setup17', 'setup17.id', '=', 'kelayakan.material_atap')
            ->leftJoin('setup_rtlh as setup18', 'setup18.id', '=', 'kelayakan.kondisi_atap')
            ->leftJoin('setup_rtlh as setup19', 'setup19.id', '=', 'kelayakan.material_dinding')
            ->leftJoin('setup_rtlh as setup20', 'setup20.id', '=', 'kelayakan.kondisi_dinding')
            ->leftJoin('setup_rtlh as setup21', 'setup21.id', '=', 'kelayakan.material_lantai')
            ->leftJoin('setup_rtlh as setup22', 'setup22.id', '=', 'kelayakan.kondisi_lantai')
            ->leftJoin('setup_rtlh as setup23', 'setup23.id', '=', 'rtlh.pendidikan')
            ->leftJoin('setup_rtlh as setup24', 'setup24.id', '=', 'kelayakan.jenis_kloset')
            ->leftJoin('setup_rtlh as setup25', 'setup25.id', '=', 'kelayakan.jenis_tpa')
            ->leftJoin('setup_rtlh as setup26', 'setup26.id', '=', 'kelayakan.kondisi_plafon')
            ->leftJoin('setup_rtlh as setup27', 'setup27.id', '=', 'kelayakan.kondisi_balok')
            ->leftJoin('setup_rtlh as setup28', 'setup28.id', '=', 'kelayakan.kondisi_sloof')
            ->leftJoin('setup_rtlh as setup29', 'setup29.id', '=', 'rtlh.kawasan_rumah')
            ->leftJoin('indonesia_districts as kec', 'kec.id', '=', 'rtlh.id_kecamatan')
            ->leftJoin('indonesia_villages as kel', 'kel.id', '=', 'rtlh.id_kelurahan')
            ->leftJoin('stts_verif', 'rtlh.stts_verif', '=', 'stts_verif.id')
            ->leftJoin(DB::raw($bukti), 'setup_bukti.id_rtlh', '=', 'rtlh.id')
            ->select(
                'rtlh.nik',
                'rtlh.no_kk',
                'rtlh.nama_lengkap',
                DB::raw("DATE_FORMAT(rtlh.tgl_lahir, '%d-%m-%Y') as tgl_lahir"),
                'rtlh.alamat_lengkap',
                'setup1.name as jenis_kelamin',
                'setup2.name as jenis_pekerjaan',
                'setup3.name as jml_penghasilan',
                'rtlh.pernah_dibantu',
                'rtlh.bantuan_dari',
                'rtlh.bantuan_dari',
                'kondisi.jml_kk',
                'kondisi.jml_penghuni',
                'kondisi.jml_kk',
                'kondisi.panjang',
                'kondisi.lebar',
                'setup4.name as stts_tanah',
                'setup5.name as stts_rumah',
                'setup6.name as stts_tanah_lain',
                'setup7.name as stts_rumah_lain',
                'kondisi.koordinat_rumah',
                'setup8.name as pondasi',
                'setup9.name as kondisi_kolom',
                'setup10.name as kondisi_konstruksi',
                'setup11.name as jendela',
                'setup12.name as ventilasi',
                'setup13.name as stts_wc',
                'setup14.name as jarak_air_tpa',
                'setup15.name as sumber_air_minum',
                'setup16.name as sumber_listrik',
                'setup17.name as material_atap',
                'setup18.name as kondisi_atap',
                'setup19.name as material_dinding',
                'setup20.name as kondisi_dinding',
                'setup21.name as material_lantai',
                'setup22.name as kondisi_lantai',
                'setup23.name as pendidikan',
                'setup24.name as jenis_kloset',
                'setup25.name as jenis_tpa',
                'setup26.name as kondisi_plafon',
                'setup27.name as kondisi_balok',
                'setup28.name as kondisi_sloof',
                'setup29.name as kawasan_rumah',
                'kec.name as kecamatan',
                'kel.name as kelurahan',
                'kel.id as kode_wilayah',
                'setup_bukti.list_name as bukti_kepemilikan',
                'stts_verif.name as ket_verif'
            );

        if ($id_kecamatan = $request->get('id_kecamatan')) {
            $query->where('rtlh.id_kecamatan', $id_kecamatan);
        }

        if ($id_kelurahan = $request->get('id_kelurahan')) {
            $query->where('rtlh.id_kelurahan', $id_kelurahan);
        }

        if ($jml_kk = $request->get('jml_kk')) {
            $query->where('rtlh_kondisi_rumah.jml_kk', $jml_kk);
        }

        $rtlh = $query->get();

        return response()->json([
            'rtlh' => $rtlh,
        ]);
    }

    public function getAllValidasi(Request $request)
    {
        $validasi = $this->_validasi();

        $filter_validasi = array_filter($validasi, function($v) {
            return strpos($v, 'required') !== false;
        });

        return response()->json([
            'validasi' => $filter_validasi,
        ]);
    }
}
