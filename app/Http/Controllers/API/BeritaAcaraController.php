<?php

namespace App\Http\Controllers\API;

use App\BeritaAcara;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BeritaAcaraCollection;
use App\Http\Resources\BeritaAcara as BeritaAcaraResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\Jadwal;

class BeritaAcaraController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BeritaAcaraCollection(BeritaAcara::all());
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
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'gte' => [
                'numeric' => 'Atribut :attribute harus memiliki nilai sama dengan atau lebih besar dari :value.',
            ],
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
        ];
        $validator = Validator::make($request->all(), [
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'tgl_pertemuan' => 'required|date_format:Y-n-j',
            'mhs_hadir' => 'required|numeric|gte:0',
            'mhs_tidak_hadir' => 'required|numeric|gte:0',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s',
            'jam_presensi_ditutup' => 'required|date_format:H:i:s|after_or_equal:jam_presensi_dibuka'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $temp_berita_acara = BeritaAcara::all()->last();
        $kd_berita_acara = "BeritaAcara0001";
        if($temp_berita_acara) $kd_berita_acara = ++$temp_berita_acara->kd_berita_acara;

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');
        
        $beritaAcara = new BeritaAcara;
        $beritaAcara->kd_berita_acara = $kd_berita_acara;
        $beritaAcara->desk_perkuliahan = $request->desk_perkuliahan;
        $beritaAcara->desk_penugasan = $request->desk_penugasan;
        $beritaAcara->tgl_pertemuan = $request->tgl_pertemuan;
        $beritaAcara->mhs_hadir = $request->mhs_hadir;
        $beritaAcara->mhs_tidak_hadir = $request->mhs_tidak_hadir;
        $beritaAcara->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        $beritaAcara->jam_presensi_ditutup = $request->jam_presensi_ditutup;
        $beritaAcara->jadwal()->associate($jadwal);
        $beritaAcara->save();
        
        return $this->sendResponse([
            'jadwal' => [new BeritaAcaraResource($beritaAcara)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BeritaAcara  $beritaAcara
     * @return \Illuminate\Http\Response
     */
    public function show(BeritaAcara $beritaAcara)
    {
        if($beritaAcara) return $this->sendResponse([
            'berita_acara' => new BeritaAcaraResource($beritaAcara)
        ],'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BeritaAcara  $beritaAcara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BeritaAcara $beritaAcara)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'gte' => [
                'numeric' => 'Atribut :attribute harus memiliki nilai sama dengan atau lebih besar dari :value.',
            ],
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
        ];
        $validator = Validator::make($request->all(), [
            'kd_berita_acara' => 'required|exists:App\BeritaAcara,kd_berita_acara',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'tgl_pertemuan' => 'required|date_format:Y-n-j',
            'mhs_hadir' => 'required|numeric|gte:0',
            'mhs_tidak_hadir' => 'required|numeric|gte:0',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s',
            'jam_presensi_ditutup' => 'required|date_format:H:i:s|after_or_equal:jam_presensi_dibuka'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');

        $beritaAcara->desk_perkuliahan = $request->desk_perkuliahan;
        $beritaAcara->desk_penugasan = $request->desk_penugasan;
        $beritaAcara->tgl_pertemuan = $request->tgl_pertemuan;
        $beritaAcara->mhs_hadir = $request->mhs_hadir;
        $beritaAcara->mhs_tidak_hadir = $request->mhs_tidak_hadir;
        $beritaAcara->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        $beritaAcara->jam_presensi_ditutup = $request->jam_presensi_ditutup;
        $beritaAcara->jadwal()->associate($jadwal);
        $beritaAcara->update();
        
        return $this->sendResponse([
            'jadwal' => [new BeritaAcaraResource($beritaAcara)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BeritaAcara  $beritaAcara
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeritaAcara $beritaAcara)
    {
        $beritaAcara->delete();
        return $this->sendResponse(null,'Berhasil menghapus data!');
    }
}
