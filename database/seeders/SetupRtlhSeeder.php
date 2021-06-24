<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SetupRtlh;
use DB;

class SetupRtlhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setup1 = SetupRtlh::create([
            'parent_id' => 0,
            'name'      => 'Identitas Diri',
        ]);

        $setup2 = SetupRtlh::create([
            'parent_id' => 0,
            'name'      => 'Kondisi Rumah',
        ]);

        $setup3 = SetupRtlh::create([
            'parent_id' => 0,
            'name'      => 'Kelayakan Rumah',
        ]);

        // Identitas diri

        SetupRtlh::create([
            'parent_id' => $setup1->id,
            'name'      => 'Jenis Kelamin',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup1->id,
            'name'      => 'Jenis Pekerjaan',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup1->id,
            'name'      => 'Jumlah Penghasilan',
        ]);

        // Kondisi Rumah

        SetupRtlh::create([
            'parent_id' => $setup2->id,
            'name'      => 'Status Kepemilikan Tanah',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup2->id,
            'name'      => 'Status Kepemilikan Rumah',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup2->id,
            'name'      => 'Aset tanah di tempat lain',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup2->id,
            'name'      => 'Aset rumah di tempat lain',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup2->id,
            'name'      => 'Bukti Kepemilikan',
        ]);

        // Kelayakan Rumah

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Pondasi',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Kondisi Kolom',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Kondisi Konstruksi Atap',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Jendela / Lubang Cahaya',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Ventilasi',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Kepemilikan Kamar Mandi dan WC',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Jarak Sumber Air Minum ke TPA Tinja',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Sumber Air Minum',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Sumber Listrik',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Material Atap',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Kondisi Atap',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Material Dinding Terluas',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Kondisi Dinding',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Material Lantai Terluas',
        ]);

        SetupRtlh::create([
            'parent_id' => $setup3->id,
            'name'      => 'Kondisi Lantai',
        ]);
    }
}
