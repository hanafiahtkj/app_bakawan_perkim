<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiGisController;
use App\Http\Controllers\Api\ApiRtlhController;
use App\Http\Controllers\Api\ApiNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ "middleware" => ['static_token']], function() {
    Route::get('geojson/rtlh', [ApiGisController::class, 'rtlh']);
    Route::get('geojson/penerima-bantuan', [ApiGisController::class, 'penerimaBantuan']);
    Route::get('rtlhRealisasi', [ApiGisController::class, 'rtlhRealisasi']);
});

Route::group([ "middleware" => ['static_token_rtlh']], function() {
    // Rtlh
    Route::get('rtlh/status-summary', [ApiRtlhController::class, 'statusSummary']);
    Route::get('rtlh/list', [ApiRtlhController::class, 'list']);
    Route::get('rtlh/realisasi', [ApiRtlhController::class, 'realisasi']);
    Route::get('recent-activity', ApiNotificationController::class);
});
