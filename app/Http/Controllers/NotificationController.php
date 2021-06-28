<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PushNotification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $id_user = Auth::user()->id;
        $notification = PushNotification::where('id_user', $id_user)
            ->limit(5)
            ->latest()
            ->get();
        return response()->json(['data' => $notification]);
    }
}
