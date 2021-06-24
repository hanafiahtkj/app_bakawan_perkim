<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupVerifFieldValue extends Model
{
    use HasFactory;

    protected $table = 'setup_verif_field_value';

    protected $fillable = [
        'setup_verif_field_id',
        'name',
        'sort_order',
    ];

    public $timestamps = false;
}
