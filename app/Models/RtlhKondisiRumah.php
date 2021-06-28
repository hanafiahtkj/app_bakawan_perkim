<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtlhKondisiRumah extends Model
{
    use HasFactory;

    protected $table = 'rtlh_kondisi_rumah';

    protected $fillable = [
        'id_rtlh',
        'jml_kk',
        'jml_penghuni',
        'panjang',
        'lebar',
        'stts_tanah',
        'stts_rumah',
        'stts_tanah_lain',
        'stts_rumah_lain',
        //'bukti_kepemilikan',
        'foto_bangunan',
        'koordinat_rumah',
    ];

    public $timestamps = false;
}
