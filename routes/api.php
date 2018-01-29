<?php

use Illuminate\Http\Request;

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

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', 'Api\UsersController@login');
    Route::post('/logout', 'Api\UsersController@login');
    Route::post('/forgot', 'Api\UsersController@forgot');
    Route::post('/registration', 'Api\UsersController@registration');
    Route::post('/reset_password', 'Api\UsersController@reset_password');
    Route::get('/roles', 'Api\UsersController@roles');

});


// Kelurahan
Route::prefix('kelurahan')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\KelurahanController@index');
    Route::get('/get_by_kecamatan/{kecamatan}', 'Api\KelurahanController@get_by_kecamatan');
});

// Kecamatan
Route::prefix('kecamatan')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\KecamatanController@index');
    Route::get('/area', 'Api\KecamatanController@area_kecamatan');
});

// Jadwal
Route::prefix('jadwal')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\JadwalController@index');
    Route::get('/lokasi/{jenis}', 'Api\JadwalController@lokasi');
});

// Dashboard
Route::prefix('dashboard')->middleware('simple.token')->group(function () {
    Route::get('/jumantik', 'Api\DashboardController@jumantik');
    Route::get('/penyakit_nyamuk_menular', 'Api\DashboardController@penyakit_nyamuk_menular');
});

// Laporan
Route::prefix('penyakit')->middleware('simple.token')->group(function () {
    Route::prefix('laporan')->group(function () {
        Route::get('/{jenis}', 'Api\Penyakit\LaporanController@index');
        Route::post('/store', 'Api\Penyakit\LaporanController@store');
        Route::post('/store_log_kejadian', 'Api\Penyakit\LaporanController@store_log_kejadian');
        Route::get('/show/{laporan}', 'Api\Penyakit\LaporanController@show');
        Route::post('/ajax_laporan', 'Api\Penyakit\LaporanController@ajax_laporan');
        Route::get('/delete/{laporan}', 'Api\Penyakit\LaporanController@delete');
        Route::put('/edit/{laporan}', 'Api\Penyakit\LaporanController@edit');
        Route::get('/detail/{detail}', 'Api\Penyakit\LaporanController@detail');


        // encapsulated api
        Route::post('/jumantik', 'Api\Penyakit\LaporanController@jumantik');
        Route::post('/fogging', 'Api\Penyakit\LaporanController@fogging')->middleware('apiCan:fogging');
        Route::post('/dinkes', 'Api\Penyakit\LaporanController@dinkes');
        Route::post('/rumah_sakit', 'Api\Penyakit\LaporanController@rumah_sakit');
        Route::post('/survey', 'Api\Penyakit\LaporanController@survey'); // Puskesmas

        // histories and to self
        Route::post('/histories', 'Api\Penyakit\LaporanController@histories');
        Route::post('/to_self', 'Api\Penyakit\LaporanController@to_self');


    });

    Route::prefix('detail_laporan')->group(function () {
        Route::post('/store', 'Api\Penyakit\DetailLaporanController@store');
        Route::post('/approval/{detail_laporan}', 'Api\Penyakit\DetailLaporanController@approval');
    });
});


// Master
Route::prefix('master')->middleware('simple.token')->group(function () {
    Route::get('/apartment', 'Api\Master\ApartementController@index');
    Route::get('/faskes', 'Api\Master\FaskesController@index');
    Route::get('/perkimtan', 'Api\Master\PerkimtanController@index');
    Route::get('/sekolah', 'Api\Master\SekolahController@index');
    Route::get('/perumahan', 'Api\Master\PerumahanController@index');
    Route::get('/tindakan', 'Api\Master\TindakanController@index');
    Route::get('/penyakit', 'Api\Master\PenyakitController@index');
    Route::post('/ketua_warga', 'Api\Master\KetuaWargaController@index');
    Route::post('/ketua_warga/destroy', 'Api\Master\KetuaWargaController@destroy');
    Route::get('/status', function () {
        $status = [
            'deleted' => [
                'id' => 0,
                'name' => 'Deleted'
            ],
            'open' => [
                'id' => 1,
                'name' => 'Open'
            ],
            'finish' => [
                'id' => 2,
                'name' => 'Finish'
            ],
            'on_going' => [
                'id' => 3,
                'name' => 'On Going'
            ],
            'surveyed' => [
                'id' => 4,
                'name' => 'Surveyed'
            ]
        ];

        return $status;
    });
});

// Notifikasi
Route::prefix('notifikasi')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\Notifikasi\SetupController@index');
    Route::post('/today', 'Api\Notifikasi\SetupController@today_mobile');
    Route::post('/today_web', 'Api\Notifikasi\SetupController@today_web');
});

// Log Activity
Route::prefix('activity')->middleware('simple.token')->group(function () {
    Route::post('/ajax_log', 'Api\ActivityController@ajax_log');
});

// Third Party API
// DISDUKCAPIL KOTA BEKASI
Route::middleware('simple.token')->post('/disduk', function (Request $request) {
    $nik = $request->input("nik");
    $kk = $request->input("kk");

    $result = \App\Utils\Disduk::get_detail_warga(trim($nik), trim($kk));

    if (!$result) return \App\Utils\ResponseMod::failed("Data tidak ditemukan");
    return \App\Utils\ResponseMod::success($result);
});

// api unauthenticated
Route::get('/403', function () {
    return [
        'message' => 'unauthenticated'
    ];
});


// test multi upload
Route::post('/multi', function (Request $request) {
    if ($request->hasFile('foto')) {

        $files = $request->file('foto');

        $fotos = [];
        foreach ($files as $file) {

            $foto = $file->store('uploads');
            array_push($fotos, $foto);
        }


        return [
            'foto ' => implode(',', $fotos)
        ];
    }
});

// Media Access
Route::get('/thumbnail/{width}/{height}/{filename}', function (Request $request, $width, $height, $filename) {

    $path = storage_path('app/uploads') . "/" . $filename;

    if (!\Illuminate\Support\Facades\File::exists($path)) abort(404);
    $file = \Illuminate\Support\Facades\File::get($path);
    $type = \Illuminate\Support\Facades\File::mimeType($path);

    $img = Image::make($path)->resize($width, $height);
    return $img->response($type);
});

Route::middleware('simple.token')->post('/notif', function (Request $request) {
    return $request->auth_user;
});

Route::get('current_user', function (Request $request) {
    return \Illuminate\Support\Facades\Auth::user();
});

