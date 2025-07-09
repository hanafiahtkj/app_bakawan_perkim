<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PushNotification;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

class ApiNotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $adminIds = User::role('Admin')->pluck('id');

        $query = PushNotification::select('title', 'body', DB::raw('MAX(id) as id'))
            ->whereIn('id_user', $adminIds)
            ->groupBy('title', 'body')
            ->orderByDesc('id');

        $limit = $request->query('limit');

        if ($limit) {
            $query->limit($limit);
        }

        $notification = $query->get();

        return response()->json($notification);
    }

}
