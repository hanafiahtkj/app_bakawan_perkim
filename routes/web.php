<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GisController;
use App\Http\Controllers\RtlhController;
use App\Http\Controllers\VerifRtlhController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGisController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRtlhController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\ImportRtlhController;
use App\Http\Controllers\Admin\SetupWilayahController;
use App\Http\Controllers\Admin\SetupRtlhController;
use App\Http\Controllers\Admin\SetupVerifController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UsersDataTabeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SyaratController;
use App\Http\Controllers\Admin\KawasanKumuhController;
use App\Http\Controllers\Admin\BantaranSungaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/check-status', [HomeController::class, 'checkStatus']);

Route::get('/sarat-dan-kententuan', [PageController::class, 'saratKetentuan']);

Route::get('/gallery', [PageController::class, 'gallery']);

Route::get('/panduan', [PageController::class, 'panduan']);

Route::get('/video', [PageController::class, 'video']);

Route::get('/post/{id}', [PageController::class, 'post']);

Route::get('/cekbantuan', [PageController::class, 'cekbantuan']);

// ===================== //

Route::group(['middleware' => ['auth']], function () {

    Route::get('/rtlh-by-nik/{nik}', [RtlhController::class, 'bynik'])->name('rtlh-by-nik');

    Route::get('/getKelurahan/{id}', [RtlhController::class, 'getKelurahan'])->name('getKelurahan');

    Route::post('/simpan-token', [FCMController::class, 'simpanToken'])->name('simpan-token');

    Route::get('/notification', NotificationController::class)->name('notification');

    Route::get('/get-all-validasi', [RtlhController::class, 'getAllValidasi'])->name('get-all-validasi');

    Route::get('webgis', GisController::class)->name('gis');

    Route::get('gis-rtlh', GisController::class)->name('gis-rtlh');

    Route::get('gis-rtlh-map1', [GisController::class, 'map1'])->name('gis-rtlh-map1');

    Route::get('gis-rtlh-map2', [GisController::class, 'map2'])->name('gis-rtlh-map2');

    Route::get('gis-kelurahan-geojson', [GisController::class, 'geojsonKelurahan'])->name('gis-kelurahan-geojson');

    Route::get('gis-kecamatan-geojson', [GisController::class, 'geojsonKecamatan'])->name('gis-kecamatan-geojson');

    Route::get('gis-kumuh-geojson', [GisController::class, 'geojsonKumuh'])->name('gis-kumuh-geojson');

    Route::get('gis-kumuh-2022-geojson', [GisController::class, 'geojsonKumuh2022'])->name('gis-kumuh-2022-geojson');

});

// ===================== //

Route::group(['middleware' => ['auth', 'role:General|TFL|Konsultan']], function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('profile-update', [ProfileController::class, 'update'])
        ->name('profile-update');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/create-rtlh', [RtlhController::class, 'create'])->name('create-rtlh');

    Route::post('/validasi-rtlh', [RtlhController::class, 'validasi'])->name('validasi-rtlh');

    Route::post('/simpan-rtlh', [RtlhController::class, 'store'])->name('simpan-rtlh');

    Route::get('/view-rtlh/{id}', [RtlhController::class, 'show'])->name('view-rtlh');

    Route::get('/edit-rtlh/{id}', [RtlhController::class, 'edit'])->name('edit-rtlh');

    Route::get('/verif-rtlh/{id}', [VerifRtlhController::class, 'show'])->name('verif-rtlh');

    Route::post('/update-rtlh', [RtlhController::class, 'update'])->name('update-rtlh');

    Route::post('/catatan-rtlh', [RtlhController::class, 'catatan'])->name('catatan-rtlh');

    Route::post('/real-rtlh', [RtlhController::class, 'realisasi'])->name('real-rtlh');

    Route::get('/getRtlhDataTables', [RtlhController::class, 'getDataTables'])->name('getRtlhDataTables');

    Route::post('/validasi-verif', [VerifRtlhController::class, 'validasi'])->name('validasi-verif');

    Route::post('/verif-rtlh', [VerifRtlhController::class, 'store'])->name('verif-rtlh');

    Route::post('/batal-verif/{id}', [VerifRtlhController::class, 'batal'])->name('batal-verif');

    Route::get('export-rtlh', [RtlhController::class, 'export'])->name('export-rtlh');
});

// ======= ADMIN ======= //

Route::group(['middleware' => ['auth', 'role:Admin']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', AdminDashboardController::class)->name('admin.dashboard');

        Route::get('filter-chart-rtlh', [AdminDashboardController::class, 'filterChart'])->name('admin.filter-chart-rtlh');

        Route::get('gis-rtlh', AdminGisController::class)->name('admin.gis-rtlh');

        Route::get('gis-rtlh-map1', [AdminGisController::class, 'map1'])->name('admin.gis-rtlh-map1');

        Route::get('gis-rtlh-map2', [AdminGisController::class, 'map2'])->name('admin.gis-rtlh-map2');

        Route::get('gis-kelurahan-geojson', [AdminGisController::class, 'geojsonKelurahan'])->name('admin.gis-kelurahan-geojson');

        Route::get('gis-kecamatan-geojson', [AdminGisController::class, 'geojsonKecamatan'])->name('admin.gis-kecamatan-geojson');

        Route::get('gis-kumuh-geojson', [AdminGisController::class, 'geojsonKumuh'])->name('admin.gis-kumuh-geojson');

        Route::get('gis-kumuh-2022-geojson', [AdminGisController::class, 'geojsonKumuh2022'])->name('admin.gis-kumuh-2022-geojson');

        Route::get('profile', [AdminProfileController::class, 'index'])->name('admin.profile');

        Route::post('profile-update', [AdminProfileController::class, 'update'])->name('admin.profile-update');

        Route::prefix('pemukiman')->group(function () {

            Route::get('kawasan-kumuh/getDataTables', [KawasanKumuhController::class, 'getDataTables'])->name('admin.kawasan-kumuh.getDataTables');

            Route::resource('kawasan-kumuh', KawasanKumuhController::class, ['as' => 'admin']);

            Route::get('bantaran-sungai/getDataTables', [BantaranSungaiController::class, 'getDataTables'])->name('admin.bantaran-sungai.getDataTables');

            Route::resource('bantaran-sungai', BantaranSungaiController::class, ['as' => 'admin']);

        });

        Route::prefix('setup')->group(function () {

            Route::get('/setup-wilayah', [SetupWilayahController::class, 'index'])->name('admin.setup-wilayah');

            Route::get('/setup-wilayah/getDataSetups/{id}', [SetupWilayahController::class, 'getDataSetups'])->name('admin.getDataSetupsWilayah');

            Route::post('/setup-wilayah/store', [SetupWilayahController::class, 'store'])->name('admin.setup-wilayah.store');

            Route::post('/setup-wilayah/destroy/{id}', [SetupWilayahController::class, 'destroy'])->name('admin.setup-wilayah.destroy');

            Route::get('/setup-rtlh', [SetupRtlhController::class, 'index'])->name('admin.setup-rtlh');

            Route::get('/setup-rtlh/getDataSetups/{id}', [SetupRtlhController::class, 'getDataSetups'])->name('admin.getDataSetups');

            Route::post('/setup-rtlh/store', [SetupRtlhController::class, 'store'])->name('admin.setup-rtlh.store');

            Route::post('/setup-rtlh/destroy/{id}', [SetupRtlhController::class, 'destroy'])->name('admin.setup-rtlh.destroy');

            Route::get('/setup-verif', [SetupVerifController::class, 'index'])->name('admin.setup-verif');

            Route::post('/setup-verif/store', [SetupVerifController::class, 'store'])->name('admin.setup-verif.store');

            Route::get('/setup-verif/getDataSetups/{id}', [SetupVerifController::class, 'getDataSetups'])->name('admin.getDataSetupsVerif');

            Route::get('/setup-verif/getDataSetupsDtl/{id}', [SetupVerifController::class, 'getDataSetupsDtl'])->name('admin.getDataSetupsVerifDtl');

            Route::post('/setup-verif/destroy/{id}', [SetupVerifController::class, 'destroy'])->name('admin.setup-verif.destroy');

        });

        Route::prefix('managemen')->group(function () {

            Route::get('getUsersDataTables', [UserController::class, 'getDataTables'])->name('admin.getUsersDataTables');

            Route::resource('users', UserController::class);

            Route::get('getRolesDataTables', [RoleController::class, 'getDataTables'])->name('admin.getRolesDataTables');

            Route::resource('roles', RoleController::class);

        });

        Route::prefix('lainnya')->group(function () {

            Route::post('posts/upload', [AdminPostController::class, 'upload'])->name('admin.posts.upload');

            Route::resource('posts', AdminPostController::class);

            Route::get('getPostsDataTables', [AdminPostController::class, 'getDataTables'])->name('admin.getPostsDataTables');

            Route::post('gallery/create-folder', [AdminGalleryController::class, 'createFolder'])->name('admin.gallery.create-folder');

            Route::post('gallery/upload', [AdminGalleryController::class, 'upload'])->name('admin.gallery.upload');

            Route::post('gallery/delete', [AdminGalleryController::class, 'delete'])->name('admin.gallery.delete');

            Route::get('gallery/getDirectory', [AdminGalleryController::class, 'getDirectory'])->name('admin.getDirectory');

            Route::get('gallery/getFiles/{id_directory}', [AdminGalleryController::class, 'getFiles'])->name('admin.getFiles');

            Route::resource('gallery', AdminGalleryController::class);

            Route::get('getVideoDataTables', [AdminVideoController::class, 'getDataTables'])->name('admin.getVideoDataTables');

            Route::resource('video', AdminVideoController::class);

            Route::get('syarat-ketentuan', SyaratController::class)->name('admin.syarat-ketentuan');

            Route::post('syarat-ketentuan/update', [SyaratController::class, 'update'])->name('admin.syarat-ketentuan.update');

        });

        Route::prefix('pemukiman')->group(function () {

            Route::get('rtlh', [AdminRtlhController::class, 'index'])->name('admin.rtlh');

            Route::get('create-rtlh', [AdminRtlhController::class, 'create'])->name('admin.create-rtlh');

            Route::post('simpan-rtlh', [AdminRtlhController::class, 'store'])->name('admin.simpan-rtlh');

            Route::post('validasi-rtlh', [AdminRtlhController::class, 'validasi'])->name('admin.validasi-rtlh');

            Route::get('view-rtlh/{id}', [AdminRtlhController::class, 'show'])->name('admin.view-rtlh');

            Route::get('edit-rtlh/{id}', [AdminRtlhController::class, 'edit'])->name('admin.edit-rtlh');

            Route::post('update-rtlh', [AdminRtlhController::class, 'update'])->name('admin.update-rtlh');

            Route::delete('hapus-rtlh/{id}', [AdminRtlhController::class, 'destroy'])->name('admin.hapus-rtlh');

            Route::get('export-rtlh', [AdminRtlhController::class, 'export'])->name('admin.export-rtlh');

            Route::get('rtlh/getDataTables', [AdminRtlhController::class, 'getDataTables'])->name('admin.getRtlhDataTables');

            Route::get('import-rtlh', [ImportRtlhController::class, 'index'])->name('admin.import-rtlh');

            Route::post('import-rtlh/upload', [ImportRtlhController::class, 'upload'])->name('admin.import-rtlh-upload');

            Route::post('/real-rtlh', [AdminRtlhController::class, 'realisasi'])->name('admin.real-rtlh');

        });
    });

});

require __DIR__.'/auth.php';
