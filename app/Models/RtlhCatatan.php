<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RtlhCatatan extends Model
{
    use HasFactory;

    protected $table = 'rtlh_catatan';

    protected $fillable = [
        'id_user',
        'id_rtlh',
        'catatan'
    ];

    protected $appends = ['tgl_notif'];

    public function getTglNotifAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
