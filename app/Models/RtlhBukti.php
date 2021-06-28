<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtlhBukti extends Model
{
    use HasFactory;

    protected $table = 'rtlh_bukti';

    protected $fillable = [
        'id_rtlh',
        'id_setup_bukti'
    ];

    public $timestamps = false;
}
