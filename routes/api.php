<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::apiResource('/staff-tu','API\StaffTataUsahaController');
Route::apiResource('/dosen','API\DosenController');
Route::apiResource('/matakuliah','API\MatakuliahController');
Route::apiResource('/hari','API\HariController');
Route::apiResource('/status-surat','API\StatusSuratController');
Route::apiResource('/status-presensi','API\StatusPresensiController');
Route::apiResource('/sesi','API\SesiController');
Route::apiResource('/kelas','API\KelasController');
Route::apiResource('/mahasiswa','API\MahasiswaController');
Route::apiResource('/beacon','API\BeaconController');
Route::apiResource('/ruang','API\RuangController');
Route::apiResource('/surat-izin','API\SuratIzinController');
Route::apiResource('/jadwal','API\JadwalController');
Route::apiResource('/berita-acara','API\BeritaAcaraController');
Route::apiResource('/kehadiran','API\KehadiranController');
Route::apiResource('/user','API\UserController');

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function(){
});
