<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\StatusRekapitulasi;
use Illuminate\Http\Request;
use App\Http\Resources\StatusRekapitulasiCollection;
use App\Http\Resources\StatusRekapitulasi as StatusRekapitulasiResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
class StatusRekapitulasiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StatusRekapitulasiCollection(StatusRekapitulasi::all());
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
            'unique' => 'Atribut :attribute harus bersifat unik.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_status_rekapitulasi' => 'required|unique:App\StatusRekapitulasi,kd_status_rekapitulasi',
            'keterangan_rekapitulasi' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        

        $isDataExist = StatusRekapitulasi::find($request->kd_status_rekapitulasi);

        if($isDataExist) return $this->sendError('Gagal menyimpan karena data \''. $isDataExist->kd_status_rekapitulasi .'\' sudah tersimpan !');
        

        $statusRekapitulasi = StatusRekapitulasi::create([
            'kd_status_rekapitulasi' => $request->kd_status_rekapitulasi,
            'keterangan_rekapitulasi' => $request->keterangan_rekapitulasi
        ]);
        return $this->sendResponse([
            'status_rekapitulasi' => [new StatusRekapitulasiResource($statusRekapitulasi)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusRekapitulasi  $statusRekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function show(StatusRekapitulasi $statusRekapitulasi)
    {
        if($statusRekapitulasi) return $this->sendResponse([
            'status_rekapitulasi' => new StatusRekapitulasiResource($statusRekapitulasi)
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusRekapitulasi  $statusRekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusRekapitulasi $statusRekapitulasi)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_status_rekapitulasi' => 'required|exists:App\StatusRekapitulasi,kd_status_rekapitulasi',
            'keterangan_rekapitulasi' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $statusRekapitulasi = StatusRekapitulasi::find($request->kd_status_rekapitulasi);
        if(!$statusRekapitulasi){
            return $this->sendError('Data tidak ditemukan!');
        }

        $statusRekapitulasi->update($request->only(['keterangan_rekapitulasi']));
        return $this->sendResponse([
            'status_rekapitulasi' => [new StatusRekapitulasiResource($statusRekapitulasi)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusRekapitulasi  $statusRekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusRekapitulasi $statusRekapitulasi)
    {
        $statusRekapitulasi->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
