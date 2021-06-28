<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtlhVerifFiles extends Model
{
    use HasFactory;

    protected $table = 'rtlh_verif_files';

    protected $fillable = [
        'id_rtlh',
        'id_rtlh_verif',
        'id_setup',
        'files',
    ];
}
