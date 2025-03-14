<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use App\Models\SetupRtlh;
use App\Models\Rtlh;
use App\Models\RtlhCatatan;
use App\Models\RtlhBukti;
use App\Models\RtlhVerif;
use App\Models\RtlhVerifFiles;
use App\Models\RtlhKondisiRumah;
use App\Models\RtlhKelayakanRumah;
use App\Models\SetupVerif;
use App\Models\SetupVerifField;
use App\Models\SetupVerifFieldValue;
use DB;
use App\Exports\RtlhExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AdminRtlhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setups = DB::table('setup_rtlh')
            ->whereIn('parent_id',array(1, 2, 3))
            ->whereNotIn('id', [11])->get();
        $setups2 = $setups->map(function($da) {
            $arr = explode('.', $da->ref);
            if (count($arr) == 2) {
                $da->ref = $arr[1];
            }
            else {
                $da->ref = null;
            }
            return $da;
        });

        $data = [
            'kecamatan' => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
            'setups'    => $setups2,
        ];

        $data['stts_realisasi'] = DB::table('stts_realisasi')->get();

        return view('admin/pages/rtlh-list', $data);
    }

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
        return view('admin/pages/create-rtlh', $data);
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

            $rtlh = Rtlh::create([
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
            ]);

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
                'panjang'           => str_replace(",", ".", $request->input('panjang1')),
                'lebar'             => str_replace(",", ".", $request->input('lebar1')),
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

            // $this->_notify(
            //     'RTLH BARU',
            //     'RTLH dengan No Nik : '.$request->input('nik').' ditambahkan oleh '. Auth::user()->name
            // );

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
            // $validasi['nik'] = 'required|unique:rtlh,nik,'.$id.',id';
            $validasi['nik'] = 'required';
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
        ];

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $rtlhVerif = RtlhVerif::where('id_rtlh', $id)->first();

        $rtlhCatatan = RtlhCatatan::where('id_rtlh', $id)->get();

        //var_dump($rtlhVerif->custom_field); die;

        $rtlhVerifFiles = DB::table('rtlh_verif_files')
            ->join('setup_verif_field', 'setup_verif_field.id', '=', 'rtlh_verif_files.id_setup')
            ->where('rtlh_verif_files.id_rtlh', $id)
            ->select('rtlh_verif_files.*', 'setup_verif_field.name')
            ->get();

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
            'uploads'           => SetupVerifField::where('id_setup', 1)->get(),
            'dataVerif'         => SetupVerifField::where('id_setup', 2)->get(),
            'rtlhVerif'         => $rtlhVerif,
            'rtlhVerifFiles'    => $rtlhVerifFiles,
            'rtlhCatatan'       => $rtlhCatatan,
        ];

        // stts = menunggu or perlu perbaikan
        return view('admin/pages/view-rtlh', $data);
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
            'profile'           => Auth::user(),
        ];

        return view('admin/pages/edit-rtlh', $data);
    }

    public function update(Request $request)
    {
        $validasi = $this->_validasi();

        if ($id = $request->input('id_rtlh')) {
            // $validasi['nik'] = 'required|unique:rtlh,nik,'.$id;
            $validasi['nik'] = 'required';
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
                'stts_verif'     => null,
            ]);

            $reqKondisi = [
                'id_rtlh'           => $id,
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

            // $this->_notify(
            //     'EDIT RTLH',
            //     'RTLH dengan No Nik : '.$request->input('nik').' diedit oleh '. Auth::user()->name
            // );

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
        try{
            DB::beginTransaction();

            Rtlh::where('id', $id)->delete();
            RtlhBukti::where('id_rtlh', $id)->delete();
            RtlhKondisiRumah::where('id_rtlh', $id)->delete();
            RtlhKelayakanRumah::where('id_rtlh', $id)->delete();
            RtlhVerif::where('id_rtlh', $id)->delete();
            RtlhVerifFiles::where('id_rtlh', $id)->delete();

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

    public function getDataTables(Request $request)
    {
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
            ->leftJoin('setup_rtlh as setup30', 'setup30.id', '=', 'kelayakan.fungsi_ruang')
            ->leftJoin('indonesia_districts as kec', 'kec.id', '=', 'rtlh.id_kecamatan')
            ->leftJoin('indonesia_villages as kel', 'kel.id', '=', 'rtlh.id_kelurahan')
            ->leftJoin('stts_verif', 'rtlh.stts_verif', '=', 'stts_verif.id')
            ->leftJoin('stts_realisasi', 'rtlh.stts_realisasi', '=', 'stts_realisasi.id')
            ->select(
                'rtlh.id',
                'rtlh.nik',
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
                'setup30.name as fungsi_ruang',
                'kec.name as kecamatan',
                'kel.name as kelurahan',
                'kel.id as kode_wilayah',
                DB::raw("DATE_FORMAT(rtlh.created_at, '%d-%m-%Y') as tanggal"),
                'stts_verif.name as ket_verif',
                'stts_realisasi.name as ket_realisasi',
                'rtlh.stts_verif',
                'rtlh.stts_realisasi'
            );

        if ($id_kecamatan = $request->get('id_kecamatan')) {
            $query->where('rtlh.id_kecamatan', $id_kecamatan);
        }

        if ($id_kelurahan = $request->get('id_kelurahan')) {
            $query->where('rtlh.id_kelurahan', $id_kelurahan);
        }

        if ($stts_verif = $request->get('stts_verif')) {
            $query->where('rtlh.stts_verif', $stts_verif);
        }

        // if ($jml_kk = $request->get('jml_kk')) {
        //     $query->where('kondisi.jml_kk', $jml_kk);
        // }

        return DataTables::of($query)->toJson();
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
            ->leftJoin('setup_rtlh as setup30', 'setup30.id', '=', 'kelayakan.fungsi_ruang')
            ->leftJoin('indonesia_districts as kec', 'kec.id', '=', 'rtlh.id_kecamatan')
            ->leftJoin('indonesia_villages as kel', 'kel.id', '=', 'rtlh.id_kelurahan')
            ->leftJoin('stts_verif', 'rtlh.stts_verif', '=', 'stts_verif.id')
            ->leftJoin(DB::raw($bukti), 'setup_bukti.id_rtlh', '=', 'rtlh.id')
            ->select(
                'rtlh.nik',
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
                'setup30.name as fungsi_ruang',
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

        if ($stts_verif = $request->get('stts_verif')) {
            $query->where('rtlh.stts_verif', $stts_verif);
        }

        // if ($jml_kk = $request->get('jml_kk')) {
        //     $query->where('rtlh_kondisi_rumah.jml_kk', $jml_kk);
        // }

        $rtlh = $query->get();

        return response()->json([
            'rtlh' => $rtlh,
        ]);
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
}
