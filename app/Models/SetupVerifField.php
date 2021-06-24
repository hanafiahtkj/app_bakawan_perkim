<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupVerifField extends Model
{
    use HasFactory;

    protected $table = 'setup_verif_field';

    protected $fillable = [
        'id_setup',
        'name',
        'type',
        'value',
        'status',
        'sort_order',
    ];

    public $timestamps = false;

    public function fieldValue()
    {
        // return $this->hasMany(SetupVerifFieldValue::class, 'setup_verif_field_id');
        return $this->hasMany(SetupVerifFieldValue::class, 'setup_verif_field_id');
    }
}
