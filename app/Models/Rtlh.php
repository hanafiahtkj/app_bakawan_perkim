<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtlh extends Model
{
    use HasFactory;

    protected $table = 'rtlh';

    protected $fillable = [
        'id_user',
        'nik',
        'no_kk',
        'nama_lengkap',
        'id_kecamatan',
        'id_kelurahan',
        'alamat_lengkap',
        'tgl_lahir',
        'jenis_kelamin',
        'jenis_pekerjaan',
        'jml_penghasilan',
        'pernah_dibantu',
        'bantuan_dari',
        'stts_verif',
        'stts_realisasi',
        'pendidikan',
        'kawasan_rumah',
    ];

    public function kondisiRumah()
    {
        return $this->hasOne(RtlhKondisiRumah::class, 'id_rtlh');
    }

    public function kelayakanRumah()
    {
        return $this->hasOne(RtlhKelayakanRumah::class, 'id_rtlh');
    }
}
