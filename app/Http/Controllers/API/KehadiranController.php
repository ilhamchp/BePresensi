<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kehadiran;
use Illuminate\Http\Request;
use App\Http\Resources\KehadiranCollection;
use App\Http\Resources\Kehadiran as KehadiranResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\Mahasiswa;
use App\Jadwal;
use App\Sesi;
use App\StatusPresensi;
use App\SuratIzin;

class KehadiranController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new KehadiranCollection(Kehadiran::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'alpha' => 'Atribut :attribute hanya boleh berupa alfabet.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'required_if' => 'Atribut :attribute dibutuhkan jika :other berisi :value.',
        ];
        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'kd_sesi' => 'required|numeric|exists:App\Sesi,kd_sesi',
            'kd_status_presensi' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'kd_surat_izin' => 'exists:App\SuratIzin,kd_surat_izin',
            'tgl_presensi' => 'required|date_format:Y-n-j',
            'jam_presensi' => 'required_if:kd_status_presensi,H|date_format:H:i:s',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');

        $sesi = Sesi::find($request->kd_sesi);
        if(!$sesi) return $this->sendError('Data sesi tidak ditemukan!');

        $statusPresensi = StatusPresensi::find($request->kd_status_presensi);
        if(!$statusPresensi) return $this->sendError('Data status presensi tidak ditemukan!');

        if($request->kd_surat_izin){
            $suratIzin = SuratIzin::find($request->kd_surat_izin);
            if(!$suratIzin) return $this->sendError('Data surat izin tidak ditemukan!'); 
        }

        $kehadiran = new Kehadiran;
        $kehadiran->tgl_presensi = $request->tgl_presensi;
        $kehadiran->jam_presensi = $request->jam_presensi;
        $kehadiran->mahasiswa()->associate($mahasiswa);
        $kehadiran->jadwal()->associate($jadwal);
        $kehadiran->sesi()->associate($sesi);
        $kehadiran->statusPresensi()->associate($statusPresensi);
        if($request->kd_surat_izin) $kehadiran->suratIzin()->associate($suratIzin);
        $kehadiran->save();
        
        return $this->sendResponse([
            'kehadiran' => [new KehadiranResource($kehadiran)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(Kehadiran $kehadiran)
    {
        if($kehadiran) return $this->sendResponse([
            'kehadiran' => new KehadiranResource($kehadiran)
        ],'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'alpha' => 'Atribut :attribute hanya boleh berupa alfabet.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'required_if' => 'Atribut :attribute dibutuhkan jika :other berisi :value.',
        ];
        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'kd_sesi' => 'required|numeric|exists:App\Sesi,kd_sesi',
            'kd_status_presensi' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'kd_surat_izin' => 'exists:App\SuratIzin,kd_surat_izin',
            'tgl_presensi' => 'required_if:kd_status_presensi,H|date_format:Y-n-j',
            'jam_presensi' => 'required_if:kd_status_presensi,H|date_format:H:i:s',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');

        $sesi = Sesi::find($request->kd_sesi);
        if(!$sesi) return $this->sendError('Data sesi tidak ditemukan!');

        $statusPresensi = StatusPresensi::find($request->kd_status_presensi);
        if(!$statusPresensi) return $this->sendError('Data status presensi tidak ditemukan!');

        if($request->kd_surat_izin){
            $suratIzin = SuratIzin::find($request->kd_surat_izin);
            if(!$suratIzin) return $this->sendError('Data surat izin tidak ditemukan!'); 
        }

        $kehadiran->tgl_presensi = $request->tgl_presensi;
        $kehadiran->jam_presensi = $request->jam_presensi;
        $kehadiran->mahasiswa()->associate($mahasiswa);
        $kehadiran->jadwal()->associate($jadwal);
        $kehadiran->sesi()->associate($sesi);
        $kehadiran->statusPresensi()->associate($statusPresensi);
        if($request->kd_surat_izin) $kehadiran->suratIzin()->associate($suratIzin);
        $kehadiran->update();
        
        return $this->sendResponse([
            'kehadiran' => [new KehadiranResource($kehadiran)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();
        return $this->sendResponse(null, 'Berhasil menghapus kehadiran!');
    }
}
