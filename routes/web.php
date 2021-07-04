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

Route::get('/sarat-dan-kententuan', [PageController::class, 'saratKetentuan']);

Route::get('/gallery', [PageController::class, 'gallery']);

Route::get('/panduan', [PageController::class, 'panduan']);

Route::get('/video', [PageController::class, 'video']);

Route::get('/post/{id}', [PageController::class, 'post']);

Route::get('/getKelurahan/{id}', [RtlhController::class, 'getKelurahan'])
    ->middleware(['auth'])->name('getKelurahan');

Route::post('/simpan-token', [FCMController::class, 'simpanToken'])
    ->middleware(['auth'])->name('simpan-token');

Route::get('/notification', NotificationController::class)
    ->middleware(['auth'])->name('notification');

Route::get('/rtlh-by-nik/{nik}', [RtlhController::class, 'bynik'])
    ->name('rtlh-by-nik');

Route::get('/get-all-validasi', [RtlhController::class, 'getAllValidasi'])
    ->middleware(['auth'])->name('get-all-validasi');

Route::group(['middleware' => ['role:General|TFL|Konsultan']], function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->middleware(['auth'])->name('profile');

    Route::post('profile-update', [ProfileController::class, 'update'])
        ->name('profile-update');

    Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth'])->name('dashboard');

    Route::get('gis-rtlh', GisController::class)
        ->middleware(['auth'])->name('gis-rtlh');

    Route::get('gis-rtlh-map1', [GisController::class, 'map1'])
        ->middleware(['auth'])->name('gis-rtlh-map1');

    Route::get('gis-rtlh-map2', [GisController::class, 'map2'])
        ->middleware(['auth'])->name('gis-rtlh-map2');

    Route::get('gis-kelurahan-geojson', [GisController::class, 'geojsonKelurahan'])
        ->middleware(['auth'])->name('gis-kelurahan-geojson');

    Route::get('gis-kecamatan-geojson', [GisController::class, 'geojsonKecamatan'])
        ->middleware(['auth'])->name('gis-kecamatan-geojson');

    Route::get('gis-kumuh-geojson', [GisController::class, 'geojsonKumuh'])
        ->middleware(['auth'])->name('gis-kumuh-geojson');

    Route::get('/create-rtlh', [RtlhController::class, 'create'])
        ->middleware(['auth'])->name('create-rtlh');

    Route::post('/validasi-rtlh', [RtlhController::class, 'validasi'])
        ->middleware(['auth'])->name('validasi-rtlh');

    Route::post('/simpan-rtlh', [RtlhController::class, 'store'])
        ->middleware(['auth'])->name('simpan-rtlh');

    Route::get('/view-rtlh/{id}', [RtlhController::class, 'show'])
        ->middleware(['auth'])->name('view-rtlh');

    Route::get('/edit-rtlh/{id}', [RtlhController::class, 'edit'])
        ->middleware(['auth'])->name('edit-rtlh');

    Route::get('/verif-rtlh/{id}', [VerifRtlhController::class, 'show'])
        ->middleware(['auth'])->name('verif-rtlh');

    Route::post('/update-rtlh', [RtlhController::class, 'update'])
        ->middleware(['auth'])->name('update-rtlh');

    Route::post('/catatan-rtlh', [RtlhController::class, 'catatan'])
        ->middleware(['auth'])->name('catatan-rtlh');

    Route::post('/real-rtlh', [RtlhController::class, 'realisasi'])
        ->middleware(['auth'])->name('real-rtlh');

    Route::get('/getRtlhDataTables', [RtlhController::class, 'getDataTables'])
        ->name('getRtlhDataTables');

    Route::post('/validasi-verif', [VerifRtlhController::class, 'validasi'])
        ->middleware(['auth'])->name('validasi-verif');
    
    Route::post('/verif-rtlh', [VerifRtlhController::class, 'store'])
        ->middleware(['auth'])->name('verif-rtlh');

    Route::post('/batal-verif/{id}', [VerifRtlhController::class, 'batal'])
        ->middleware(['auth'])->name('batal-verif');

    Route::get('export-rtlh', [RtlhController::class, 'export'])
        ->middleware(['auth'])->name('export-rtlh');
});

// ======= ADMIN ======= //

Route::group(['middleware' => ['role:Admin']], function () {

    Route::prefix('admin')->group(function () {
        
        Route::get('dashboard', AdminDashboardController::class)
            ->middleware(['auth'])->name('admin.dashboard');

        Route::get('filter-chart-rtlh', [AdminDashboardController::class, 'filterChart'])
            ->middleware(['auth'])->name('admin.filter-chart-rtlh');

        Route::get('gis-rtlh', AdminGisController::class)
            ->middleware(['auth'])->name('admin.gis-rtlh');

        Route::get('gis-rtlh-map1', [AdminGisController::class, 'map1'])
            ->middleware(['auth'])->name('admin.gis-rtlh-map1');

        Route::get('gis-rtlh-map2', [AdminGisController::class, 'map2'])
            ->middleware(['auth'])->name('admin.gis-rtlh-map2');

        Route::get('gis-kelurahan-geojson', [AdminGisController::class, 'geojsonKelurahan'])
            ->middleware(['auth'])->name('admin.gis-kelurahan-geojson');

        Route::get('gis-kecamatan-geojson', [AdminGisController::class, 'geojsonKecamatan'])
            ->middleware(['auth'])->name('admin.gis-kecamatan-geojson');

        Route::get('gis-kumuh-geojson', [AdminGisController::class, 'geojsonKumuh'])
            ->middleware(['auth'])->name('admin.gis-kumuh-geojson');

        Route::get('profile', [AdminProfileController::class, 'index'])
            ->middleware(['auth'])->name('admin.profile');

        Route::post('profile-update', [AdminProfileController::class, 'update'])
            ->middleware(['auth'])->name('admin.profile-update');
        
        Route::prefix('setup')->group(function () {

            Route::get('/setup-wilayah', [SetupWilayahController::class, 'index'])
                ->middleware(['auth'])->name('admin.setup-wilayah');

            Route::get('/setup-wilayah/getDataSetups/{id}', [SetupWilayahController::class, 'getDataSetups'])
                ->middleware(['auth'])->name('admin.getDataSetupsWilayah');

            Route::post('/setup-wilayah/store', [SetupWilayahController::class, 'store'])
                ->middleware(['auth'])->name('admin.setup-wilayah.store');

            Route::post('/setup-wilayah/destroy/{id}', [SetupWilayahController::class, 'destroy'])
                ->middleware(['auth'])->name('admin.setup-wilayah.destroy');

            Route::get('/setup-rtlh', [SetupRtlhController::class, 'index'])
                ->middleware(['auth'])->name('admin.setup-rtlh');

            Route::get('/setup-rtlh/getDataSetups/{id}', [SetupRtlhController::class, 'getDataSetups'])
                ->middleware(['auth'])->name('admin.getDataSetups');

            Route::post('/setup-rtlh/store', [SetupRtlhController::class, 'store'])
                ->middleware(['auth'])->name('admin.setup-rtlh.store');

            Route::post('/setup-rtlh/destroy/{id}', [SetupRtlhController::class, 'destroy'])
                ->middleware(['auth'])->name('admin.setup-rtlh.destroy');

            Route::get('/setup-verif', [SetupVerifController::class, 'index'])
                ->middleware(['auth'])->name('admin.setup-verif');

            Route::post('/setup-verif/store', [SetupVerifController::class, 'store'])
                ->middleware(['auth'])->name('admin.setup-verif.store');
    
            Route::get('/setup-verif/getDataSetups/{id}', [SetupVerifController::class, 'getDataSetups'])
                ->middleware(['auth'])->name('admin.getDataSetupsVerif');
    
            Route::get('/setup-verif/getDataSetupsDtl/{id}', [SetupVerifController::class, 'getDataSetupsDtl'])
                ->middleware(['auth'])->name('admin.getDataSetupsVerifDtl');
    
            Route::post('/setup-verif/destroy/{id}', [SetupVerifController::class, 'destroy'])
                ->middleware(['auth'])->name('admin.setup-verif.destroy');

        });

        Route::prefix('managemen')->group(function () {

            Route::get('getUsersDataTables', [UserController::class, 'getDataTables'])
                ->middleware(['auth'])->name('admin.getUsersDataTables');

            Route::resource('users', UserController::class)->middleware(['auth']);

            Route::get('getRolesDataTables', [RoleController::class, 'getDataTables'])
                ->middleware(['auth'])->name('admin.getRolesDataTables');

            Route::resource('roles', RoleController::class)->middleware(['auth']);

        });

        Route::prefix('lainnya')->group(function () {

            Route::post('posts/upload', [AdminPostController::class, 'upload'])
                ->middleware(['auth'])->name('admin.posts.upload');

            Route::resource('posts', AdminPostController::class)->middleware(['auth']);

            Route::get('getPostsDataTables', [AdminPostController::class, 'getDataTables'])
                ->middleware(['auth'])->name('admin.getPostsDataTables');

            Route::post('gallery/create-folder', [AdminGalleryController::class, 'createFolder'])
                ->middleware(['auth'])->name('admin.gallery.create-folder');

            Route::post('gallery/upload', [AdminGalleryController::class, 'upload'])
                ->middleware(['auth'])->name('admin.gallery.upload');

            Route::post('gallery/delete', [AdminGalleryController::class, 'delete'])
                ->middleware(['auth'])->name('admin.gallery.delete');

            Route::get('gallery/getDirectory', [AdminGalleryController::class, 'getDirectory'])
                ->middleware(['auth'])->name('admin.getDirectory');

            Route::get('gallery/getFiles/{id_directory}', [AdminGalleryController::class, 'getFiles'])
                ->middleware(['auth'])->name('admin.getFiles');

            Route::resource('gallery', AdminGalleryController::class)->middleware(['auth']);

            Route::get('getVideoDataTables', [AdminVideoController::class, 'getDataTables'])
                ->middleware(['auth'])->name('admin.getVideoDataTables');

            Route::resource('video', AdminVideoController::class)->middleware(['auth']);

            Route::get('syarat-ketentuan', SyaratController::class)
                ->middleware(['auth'])->name('admin.syarat-ketentuan');

            Route::post('syarat-ketentuan/update', [SyaratController::class, 'update'])
                ->middleware(['auth'])->name('admin.syarat-ketentuan.update');

        });

        Route::prefix('report')->group(function () {

            Route::get('rtlh', [AdminRtlhController::class, 'index'])
                ->middleware(['auth'])->name('admin.rtlh');

            Route::get('create-rtlh', [AdminRtlhController::class, 'create'])
                ->middleware(['auth'])->name('admin.create-rtlh');

            Route::post('simpan-rtlh', [AdminRtlhController::class, 'store'])
                ->middleware(['auth'])->name('admin.simpan-rtlh');

            Route::post('validasi-rtlh', [AdminRtlhController::class, 'validasi'])
                ->middleware(['auth'])->name('admin.validasi-rtlh');

            Route::get('view-rtlh/{id}', [AdminRtlhController::class, 'show'])
                ->middleware(['auth'])->name('admin.view-rtlh');

            Route::get('edit-rtlh/{id}', [AdminRtlhController::class, 'edit'])
                ->middleware(['auth'])->name('admin.edit-rtlh');

            Route::post('update-rtlh', [AdminRtlhController::class, 'update'])
                ->middleware(['auth'])->name('admin.update-rtlh');

            Route::delete('hapus-rtlh/{id}', [AdminRtlhController::class, 'destroy'])
                ->middleware(['auth'])->name('admin.hapus-rtlh');

            Route::get('export-rtlh', [AdminRtlhController::class, 'export'])
                ->middleware(['auth'])->name('admin.export-rtlh');

            Route::get('rtlh/getDataTables', [AdminRtlhController::class, 'getDataTables'])
                ->middleware(['auth'])->name('admin.getRtlhDataTables');

            Route::get('import-rtlh', [ImportRtlhController::class, 'index'])
                ->middleware(['auth'])->name('admin.import-rtlh');

            Route::post('import-rtlh/upload', [ImportRtlhController::class, 'upload'])
                ->middleware(['auth'])->name('admin.import-rtlh-upload');

            Route::post('/real-rtlh', [AdminRtlhController::class, 'realisasi'])
                ->middleware(['auth'])->name('admin.real-rtlh');

        });
    });

});

require __DIR__.'/auth.php';
