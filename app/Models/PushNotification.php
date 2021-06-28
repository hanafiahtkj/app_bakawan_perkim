<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PushNotification extends Model
{
    use HasFactory;

    protected $table = 'push_notifications';

    protected $fillable = [
        'title',
        'body',
        'img'
    ];

    protected $appends = ['tgl_notif'];

    public function getTglNotifAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
