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

        // Kolom `created_at` harus disertakan dalam select
        $query = PushNotification::select('title', 'body', DB::raw('MAX(id) as id'), DB::raw('MAX(created_at) as created_at'))
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
