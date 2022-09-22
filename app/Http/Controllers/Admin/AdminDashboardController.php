<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rtlh;
use DB;

class AdminDashboardController extends AdminController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $totalUsers = $this->_totalUsers();
        $totalRtlh  = $this->_totalRtlh();
        $chart      = $this->_dataChart();
        $setups     = DB::table('setup_rtlh')->whereIn('parent_id',array(1,2,3))->get();

        return view('admin/pages/dashboard', compact('totalUsers', 'totalRtlh', 'chart', 'setups'));
    }

    function _totalUsers()
    {
        $total = [
            'tot_admin'   => User::role('Admin')->count(),
            'tot_tfl'     => User::role('TFL')->count(),
            'tot_general' => User::role('General')->count(),
            'tot_konsult' => User::role('Konsultan')->count(),
            'tot_rtlh'    => Rtlh::count(),
        ];

        return $total;
    }

    function _totalRtlh()
    {
        $total = [
            'tot_all'       => $this->_queryRtlh()->count(),
            'tot_menunggu'  => $this->_queryRtlh()->where('rtlh.stts_verif', null)->count(),
            'tot_diterima'  => $this->_queryRtlh()->where('rtlh.stts_verif', 1)->count(),
            'tot_ditolak'   => $this->_queryRtlh()->where('rtlh.stts_verif', 2)->count(),
            'tot_perbaikan' => $this->_queryRtlh()->where('rtlh.stts_verif', 3)->count(),
            'tot_realisasi' => $this->_queryRtlh()->where('rtlh.stts_realisasi', 1)->count(),
        ];

        return $total;
    }

    function _queryRtlh()
    {
        $query = DB::table('rtlh');

        return $query;
    }

    function _dataChart()
    {
        $label = [];
        $total = [];
        for ($i = 0; $i <= 7; $i++)  {
            array_unshift($label, date("M-Y", strtotime( date( 'Y-m-01' )." -$i months")));

            $count = DB::table('rtlh')->whereYear('created_at', '=', date("Y", strtotime( date( 'Y-m-01' )." -$i months")))
               ->whereMonth('created_at', '=', date("m", strtotime( date( 'Y-m-01' )." -$i months")))
               ->count();

            array_unshift($total, $count);
        }

        $chart = array(
            'total'     => $total,
      		'label_all' => $label,
        );

        return $chart;
    }

    public function filterChart(Request $request)
    {
        $label = [];
        $total = [];
        $id_setup = $request->get('id_setup');
        $ref = DB::table('setup_rtlh')->where('id', $id_setup)->value('ref');
        $setups = DB::table('setup_rtlh')->where('parent_id', $id_setup)->get();
        foreach ($setups as $key => $setup) {
            $label[] = $setup->name;

            $count = DB::table('rtlh')
                ->join('rtlh_kondisi_rumah', 'rtlh_kondisi_rumah.id_rtlh', '=', 'rtlh.id')
                ->join('rtlh_kelayakan_rumah', 'rtlh_kelayakan_rumah.id_rtlh', '=', 'rtlh.id')
                ->where($ref, $setup->id)
                ->count();

            $total[] = $count;
        }

        $chart = array(
            'total'     => $total,
      		'label_all' => $label,
        );

        return response()->json([
            'status' => true,
            'data' => $chart,
        ]);
    }
}
