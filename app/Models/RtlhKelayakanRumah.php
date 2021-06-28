<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtlhKelayakanRumah extends Model
{
    use HasFactory;

    protected $table = 'rtlh_kelayakan_rumah';

    protected $fillable = [
        'id_rtlh',
        'pondasi',
        'kondisi_kolom',
        'kondisi_konstruksi',
        'jendela',
        'ventilasi',
        'stts_wc',
        'jarak_air_tpa',
        'sumber_air_minum',
        'sumber_listrik',
        'panjang',
        'lebar',
        'material_atap',
        'kondisi_atap',
        'material_dinding',
        'kondisi_dinding',
        'material_lantai',
        'kondisi_lantai',
        'jenis_kloset',
        'jenis_tpa',
        'kondisi_plafon',
        'kondisi_balok',
        'kondisi_sloof',
        'fungsi_ruang',
    ];

    public $timestamps = false;
}
