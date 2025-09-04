<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rtlh;
use DB;
use App\Models\RtlhCatatan;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $query = DB::table('rtlh');

        $data = [
            'tot_diterima'  => DB::table('rtlh')->where('rtlh.stts_verif', 1)->where('rtlh.stts_realisasi', null)->count(),

            'tot_realisasi' => DB::table('rtlh')->where('rtlh.stts_realisasi', 1)->count(),

            'tot_tanpa_wc'  => DB::table('rtlh')
                ->join('rtlh_kelayakan_rumah', 'rtlh_kelayakan_rumah.id_rtlh', '=', 'rtlh.id')
                ->where('rtlh.stts_verif', 1)
                ->where('rtlh.stts_realisasi', null)
                ->where('rtlh_kelayakan_rumah.stts_wc', 2476)
                ->count(),

            'tot_memiliki_wc'  => DB::table('rtlh')
                ->join('rtlh_kelayakan_rumah', 'rtlh_kelayakan_rumah.id_rtlh', '=', 'rtlh.id')
                ->where('rtlh.stts_verif', 1)
                ->where('rtlh.stts_realisasi', 1)
                ->where('rtlh_kelayakan_rumah.stts_wc', '!=', 2476)
                ->count(),
        ];

        return view('welcome', $data);
        // return view('sarat_ketentuan');
    }

    /**
     * Helper function to mask NIK/KK.
     */
    private function maskId($id)
    {
        if (strlen($id) < 8) {
            return $id;
        }
        // Ambil 4 digit pertama dan 4 digit terakhir, sisanya ditutup
        return substr($id, 0, 4) . '****' . substr($id, -4);
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'nik_kk' => 'required|string|min:16|max:16',
        ]);

        $nik_kk = $request->input('nik_kk');

        $bukti =
            "(SELECT GROUP_CONCAT(setup_rtlh.name) as list_name, id_rtlh
            FROM rtlh_bukti join setup_rtlh on setup_rtlh.id = rtlh_bukti.id_setup_bukti
            GROUP BY rtlh_bukti.id_rtlh) AS setup_bukti";

        $query = DB::table('rtlh')
            ->join('rtlh_kondisi_rumah as kondisi', 'kondisi.id_rtlh', '=', 'rtlh.id')
            ->leftJoin('setup_rtlh as setup1', 'setup1.id', '=', 'rtlh.jenis_kelamin')
            ->leftJoin('setup_rtlh as setup2', 'setup2.id', '=', 'rtlh.jenis_pekerjaan')
            ->leftJoin('setup_rtlh as setup23', 'setup23.id', '=', 'rtlh.pendidikan')
            ->leftJoin('setup_rtlh as setup29', 'setup29.id', '=', 'rtlh.kawasan_rumah')
            ->leftJoin('indonesia_districts as kec', 'kec.id', '=', 'rtlh.id_kecamatan')
            ->leftJoin('indonesia_villages as kel', 'kel.id', '=', 'rtlh.id_kelurahan')
            ->leftJoin('stts_verif', 'rtlh.stts_verif', '=', 'stts_verif.id')
            ->leftJoin(DB::raw($bukti), 'setup_bukti.id_rtlh', '=', 'rtlh.id')
            ->select(
                'rtlh.id',
                'rtlh.nik',
                'rtlh.no_kk',
                'rtlh.nama_lengkap',
                'rtlh.alamat_lengkap',
                'rtlh.pernah_dibantu',
                'rtlh.bantuan_dari',
                'stts_verif.name as status_verifikasi',
                DB::raw("DATE_FORMAT(rtlh.updated_at, '%d %M %Y') as tanggal_bantuan"),
                'rtlh.stts_verif',
                'rtlh.stts_realisasi',
                DB::raw("DATE_FORMAT(rtlh.created_at, '%d %M %Y') as tanggal_terdaftar")
            )
            ->where('rtlh.nik', $nik_kk)
            ->orWhere('rtlh.no_kk', $nik_kk)
            ->first();

        if (!$query) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Data tidak ditemukan. NIK atau Nomor KK tidak terdaftar.'
            ], 404);
        }

        // Terapkan masking pada NIK dan KK
        $query->nik = $this->maskId($query->nik);
        $query->no_kk = $this->maskId($query->no_kk);

        $catatan = RtlhCatatan::where('id_rtlh', $query->id)->first();
        $keterangan_tambahan = $catatan ? $catatan->catatan : 'Tidak ada keterangan tambahan.';

        $status_label = 'Menunggu Verifikasi';
        $status_type = 'info';
        $icon_class = 'fas fa-hourglass-half';

        if ($query->stts_realisasi == 1) {
            $status_label = 'Sudah Direalisasi';
            $status_type = 'success';
            $icon_class = 'fas fa-check-circle';
        } else {
            switch ($query->stts_verif) {
                case 1:
                    $status_label = 'Diterima';
                    $status_type = 'success';
                    $icon_class = 'fas fa-check-circle';
                    break;
                case 2:
                    $status_label = 'Ditolak';
                    $status_type = 'danger';
                    $icon_class = 'fas fa-times-circle';
                    break;
                case 3:
                    $status_label = 'Perlu Perbaikan';
                    $status_type = 'warning';
                    $icon_class = 'fas fa-exclamation-triangle';
                    break;
                default:
                    $status_label = 'Menunggu Verifikasi';
                    $status_type = 'info';
                    $icon_class = 'fas fa-hourglass-half';
                    break;
            }
        }

        return response()->json([
            'status' => 'success',
            'data'   => $query,
            'modal_info' => [
                'label' => $status_label,
                'type'  => $status_type,
                'icon'  => $icon_class,
                'keterangan_tambahan' => $keterangan_tambahan
            ]
        ]);
    }
}
