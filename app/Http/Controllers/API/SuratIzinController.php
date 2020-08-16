<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\SuratIzin;
use Illuminate\Http\Request;
use App\Http\Resources\SuratIzinCollection;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\Http\Resources\StatusPresensiCollection;
use App\Http\Resources\MahasiswaCollection;
use App\Http\Resources\StatusSuratCollection;
use App\StatusPresensi;
use App\Mahasiswa;
use App\StatusSurat;

class SuratIzinController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SuratIzinCollection(SuratIzin::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_jenis_izin' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
            'jam_mulai' => 'date_format:H:i:s',
            'jam_selesai' => 'date_format:H:i:s',
            'status_surat' => 'required|numeric|exists:App\StatusSurat,kd_status_surat',
            'foto_surat' => 'required|unique:App\SuratIzin,foto_surat'
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $jenis_izin = StatusPresensi::find($request->kd_jenis_izin);
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $status_surat = StatusSurat::find($request->status_surat);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $temp_surat = SuratIzin::all()->last();
        $kd_surat_izin = 'SuratIzin0001';
        if($temp_surat){
            $kd_surat_izin = ++$temp_surat->kd_surat_izin; 
        }

        $suratIzin = new SuratIzin;
        $suratIzin->kd_surat_izin = $kd_surat_izin;
        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        if($request->jam_mulai) $suratIzin->jam_mulai = $request->jam_mulai;
        if($request->jam_selesai) $suratIzin->jam_selesai = $request->jam_selesai;
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        if($request->catatan_wali_dosen) $suratIzin->catatan_wali_dosen = $request->catatan_wali_dosen;
        $suratIzin->foto_surat = $request->foto_surat;
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->save();
        return $this->sendResponse([
            'surat_izin' => [$suratIzin]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function show(SuratIzin $suratIzin)
    {
        $suratIzin = SuratIzin::find($suratIzin);
        if($suratIzin) return new SuratIzinCollection($suratIzin);
        return $this->sendError('Data surat izin tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratIzin $suratIzin)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_surat_izin' => 'required|exists:App\SuratIzin,kd_surat_izin',
            'kd_jenis_izin' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
            'jam_mulai' => 'date_format:H:i:s',
            'jam_selesai' => 'date_format:H:i:s',
            'status_surat' => 'required|numeric|exists:App\StatusSurat,kd_status_surat',
            'foto_surat' => 'required'
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $jenis_izin = StatusPresensi::find($request->kd_jenis_izin);
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $status_surat = StatusSurat::find($request->status_surat);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        if($request->jam_mulai) $suratIzin->jam_mulai = $request->jam_mulai;
        if($request->jam_selesai) $suratIzin->jam_selesai = $request->jam_selesai;
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        if($request->catatan_wali_dosen) $suratIzin->catatan_wali_dosen = $request->catatan_wali_dosen;
        $suratIzin->foto_surat = $request->foto_surat;
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->update();
        return $this->sendResponse([
            'surat_izin' => [$suratIzin]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratIzin $suratIzin)
    {
        $suratIzin->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
