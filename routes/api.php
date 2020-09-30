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
// API Untuk Aplikasi Mobile

Route::group(['prefix' => 'mobile'], function () {
    Route::get('/jadwal/mahasiswa/{mahasiswa}', 'API\JadwalController@jadwalMahasiswa');
    Route::get('/jadwal/dosen/{dosen}', 'API\JadwalController@jadwalDosen');
    Route::get('/jadwal/diampu-dosen/{dosen}', 'API\JadwalController@jadwalDiampuDosen');
    Route::get('/jadwal/detail/{jadwal}', 'API\JadwalController@show');
    Route::post('/jadwal/ubah-toleransi-keterlambatan/', 'API\JadwalController@ubahToleransiKeterlambatan');
    Route::post('/jadwal/sesi-presensi/buka/{jadwal}','API\JadwalController@bukaSesiPresensi');
    Route::post('/jadwal/sesi-presensi/tutup/{jadwal}','API\JadwalController@tutupSesiPresensi');
    Route::post('/berita-acara/buat/','API\BeritaAcaraController@buatBeritaAcara');
    Route::get('/berita-acara/detail/{beritaAcara}','API\BeritaAcaraController@show');
    Route::post('/presensi/catat/','API\KehadiranController@catatPresensi');
    Route::get('/presensi/presentase-kehadiran/{jadwal}','API\KehadiranController@persentaseKehadiran');
    Route::get('/presensi/daftar-hadir/','API\KehadiranController@daftarHadir');
    Route::get('/presensi/detail-kehadiran/{kehadiran}', 'API\KehadiranController@detailKehadiran');
    Route::post('/presensi/ubah-status/', 'API\KehadiranController@ubahStatusKehadiran');
    Route::post('/surat-izin/ajukan-izin/', 'API\SuratIzinController@ajukanSuratIzin');
    Route::post('/surat-izin/ajukan-dispen/', 'API\SuratIzinController@ajukanSuratDispen');
    Route::post('/surat-izin/ajukan-sakit/', 'API\SuratIzinController@ajukanSuratSakit');
    Route::post('/surat-izin/setujui-surat/', 'API\SuratIzinController@setujuiSurat');
    Route::post('/surat-izin/tolak-surat/', 'API\SuratIzinController@tolakSurat');
    Route::get('/surat-izin/daftar-surat/', 'API\SuratIzinController@daftarSuratIzin');
    Route::get('/surat-izin/detail-surat/{suratIzin}', 'API\SuratIzinController@show');
    Route::get('/surat-izin/surat-diproses/', 'API\SuratIzinController@daftarSuratDiproses');
    Route::get('/surat-izin/surat-belum-diproses/', 'API\SuratIzinController@daftarSuratBelumDiproses');
    Route::get('/rekapitulasi-kehadiran/detail/{rekapitulasi}', 'API\RekapitulasiController@detailRekapKehadiran');
    Route::get('/riwayat-kehadiran/{mahasiswa}', 'API\KehadiranController@riwayatKehadiran');
});

// API Untuk Aplikasi Web
Route::apiResource('/staff-tu', 'API\StaffTataUsahaController', ['parameters' => [
    'staff-tu' => 'staffTataUsaha'
]]);
Route::apiResource('/dosen','API\DosenController');
Route::apiResource('/matakuliah','API\MatakuliahController');
Route::apiResource('/hari','API\HariController');
Route::apiResource('/status-surat','API\StatusSuratController');
Route::apiResource('/status-presensi','API\StatusPresensiController');
Route::apiResource('/status-rekapitulasi','API\StatusRekapitulasiController');
Route::apiResource('/sesi','API\SesiController');
Route::apiResource('/kelas', 'API\KelasController', ['parameters' => [
    'kelas' => 'kelas'
]]);
Route::apiResource('/mahasiswa','API\MahasiswaController');
Route::apiResource('/beacon','API\BeaconController');
Route::apiResource('/ruang','API\RuangController');
Route::apiResource('/surat-izin','API\SuratIzinController');
Route::apiResource('/jadwal','API\JadwalController');
Route::apiResource('/berita-acara','API\BeritaAcaraController');
Route::apiResource('/kehadiran','API\KehadiranController');
Route::apiResource('/user','API\UserController');
Route::apiResource('/rekapitulasi','API\RekapitulasiController');

Route::get('/rekapitulasi-reload','API\RekapitulasiController@reloadDataRekapitulasi');
Route::get('/rekapitulasi-refresh','API\RekapitulasiController@refreshDataRekapitulasi');
Route::get('/dropdown-user','API\UserController@dropdownUser');
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function(){
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});
