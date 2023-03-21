<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Indonesia\Models\Kecamatan;
use DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = [
            'tot_all' => $this->_queryRtlh()->count(),
            'tot_menunggu'  => $this->_queryRtlh()->where('rtlh.stts_verif', null)->count(),
            'tot_diterima'  => $this->_queryRtlh()->where('rtlh.stts_verif', 1)->count(),
            'tot_ditolak'   => $this->_queryRtlh()->where('rtlh.stts_verif', 2)->count(),
            'tot_perbaikan' => $this->_queryRtlh()->where('rtlh.stts_verif', 3)->count(),
            'kecamatan'     => Kecamatan::where('city_id', 6371)->pluck('name', 'id'),
        ];

        if (Auth::user()->hasRole(['General', 'Konsultan'])) {
            return view('dashboard', $data);
        } else {
            $data['stts_realisasi'] = DB::table('stts_realisasi')->get();
            return view('dashboard_tfl', $data);
        }
    }

    function _queryRtlh()
    {
        $query = DB::table('rtlh')
            ->leftJoin('stts_verif', 'rtlh.stts_verif', '=', 'stts_verif.id')
            ->select('rtlh.*', 'stts_verif.stts_verif', 'stts_verif.name ket_verif');

        $user = Auth::user();
        if ($user->hasRole(['General', 'Konsultan'])) {
            $query->where('rtlh.id_user', $user->id);
        }

        return $query;
    }
}
