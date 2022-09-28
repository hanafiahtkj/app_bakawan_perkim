<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;

class KawasanKumuh extends Model
{
    use HasFactory;

    protected $table = 'kawasan_kumuh';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'id_kecamatan');
    }

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'id_kelurahan');
    }
}
