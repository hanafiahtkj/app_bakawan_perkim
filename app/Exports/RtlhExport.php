<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Rtlh;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use DB;

class RtlhExport implements FromView, WithEvents, WithColumnWidths, ShouldAutoSize, WithColumnFormatting
{
    protected $request;

    protected $rowCount;

    public function __construct(Request $request) 
    {
        $this->rowCount = 1;
        $this->request  = $request;
    }

    public function view(): View
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
                DB::raw("(kondisi.panjang * kondisi.lebar) as luas1"),
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
                'kelayakan.panjang as panjang2',
                'kelayakan.lebar as lebar2',
                DB::raw("(kelayakan.panjang * kelayakan.lebar) as luas2"),
                'kec.name as kecamatan',
                'kel.name as kelurahan',
                'kel.id as kode_wilayah',
                'setup_bukti.list_name as bukti_kepemilikan',
                'stts_verif.name as ket_verif'
            );
        
        if ($id_kecamatan = $this->request->get('id_kecamatan')) {
            $query->where('rtlh.id_kecamatan', $id_kecamatan);
        }
        
        if ($id_kelurahan = $this->request->get('id_kelurahan')) {
            $query->where('rtlh.id_kelurahan', $id_kelurahan);
        }

        if ($stts_verif = $this->request->get('stts_verif')) {
            $query->where('rtlh.stts_verif', $stts_verif);
        }

        // if ($jml_kk = $this->request->get('jml_kk')) {
        //     $query->where('rtlh_kondisi_rumah.jml_kk', $jml_kk);
        // }

        $rtlh = $query->get();
        $this->rowCount = $rtlh->count() + 1;

        //echo view('excel.rtlh', compact('rtlh')); die();

        return view('excel.rtlh', compact('rtlh'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:AW1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()
                    ->setSize(12)
                    ->setBold(true);

                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('E0E0E0');

                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(50);

                $event->sheet->getDelegate()->getStyle($cellRange)
                    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A1:AW'.$this->rowCount)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'F' => 50,        
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_NUMBER
        ];
    }
}
