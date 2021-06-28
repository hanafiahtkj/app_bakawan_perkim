<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupRtlh extends Model
{
    use HasFactory;

    protected $table = 'setup_rtlh';

    protected $fillable = [
        'parent_id',
        'name',
        'status',
    ];
}
