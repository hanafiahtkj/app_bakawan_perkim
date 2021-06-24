<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtlhVerif extends Model
{
    use HasFactory;

    protected $table = 'rtlh_verif';

    protected $fillable = [
        'id_rtlh',
        'id_user',
        'nik',
        'nama_lengkap',
        'alamat_lengkap',
        'jenis_pekerjaan',
        'jml_penghasilan',
        'koordinat_rumah',
        // 'dibawah_umk',
        // 'sudah_berkeluarga',
        // 'menguasai_tanah',
        // 'blm_memiliki_rumah',
        // 'blm_menerima_bantuan',
        'custom_field',
        'catatan',
        'stts_verif',
    ];

    protected $casts = [
        'custom_field' => 'array',
    ];
}
