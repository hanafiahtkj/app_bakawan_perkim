<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FCMController extends Controller
{
    public function simpanToken(Request $request)
    {
        $token = $request->input('token');

        User::where('fcm_token', $token)
            ->update(['fcm_token' => null]);

        $id   = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->fcm_token = $token;
        $user->save();

        return response()->json([
            'status' => true,
            'token' => $token,
            //'msg' => $e->getMessage(),
        ]);
    }
}
