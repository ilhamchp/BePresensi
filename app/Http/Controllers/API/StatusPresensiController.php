<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\StatusPresensi;
use Illuminate\Http\Request;
use App\Http\Resources\StatusPresensiCollection;
use App\Http\Resources\StatusPresensi as StatusPresensiResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;

class StatusPresensiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StatusPresensiCollection(StatusPresensi::all());
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
        ];
        $validator = Validator::make($request->all(), [
            'kd_status_presensi' => 'required',
            'keterangan_presensi' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        

        $isDataExist = StatusPresensi::find($request->kd_status_presensi);

        if($isDataExist) return $this->sendError('Gagal menyimpan karena data \''. $isDataExist->kd_status_presensi .'\' sudah tersimpan !');
        

        $statusPresensi = StatusPresensi::create([
            'kd_status_presensi' => $request->kd_status_presensi,
            'keterangan_presensi' => $request->keterangan_presensi
        ]);
        return $this->sendResponse([
            'status_presensi' => [new StatusPresensiResource($statusPresensi)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusPresensi  $statusPresensi
     * @return \Illuminate\Http\Response
     */
    public function show(StatusPresensi $statusPresensi)
    {
        if($statusPresensi) return $this->sendResponse([
            'status_presensi' => new StatusPresensiResource($statusPresensi)
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusPresensi  $statusPresensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusPresensi $statusPresensi)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_status_presensi' => 'required',
            'keterangan_presensi' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $statusPresensi = StatusPresensi::find($request->kd_status_presensi);
        if(!$statusPresensi){
            return $this->sendError('Data tidak ditemukan!');
        }

        $statusPresensi->update($request->only(['keterangan_presensi']));
        return $this->sendResponse([
            'status_presensi' => [new StatusPresensiResource($statusPresensi)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusPresensi  $statusPresensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusPresensi $statusPresensi)
    {
        $statusPresensi->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
