<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupVerif extends Model
{
    use HasFactory;

    protected $table = 'setup_verif';

    protected $fillable = [
        'parent_id',
        'name',
        'status',
    ];
}
