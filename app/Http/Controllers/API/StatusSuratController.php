<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\StatusSurat;
use Illuminate\Http\Request;
use App\Http\Resources\StatusSuratCollection;
use App\Http\Resources\StatusSurat as StatusSuratResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
class StatusSuratController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StatusSuratCollection(StatusSurat::all());
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
            'keterangan_surat' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        
        $isDataExist = StatusSurat::where('keterangan_surat', '=', $request->keterangan_surat)->first();

        if($isDataExist) return $this->sendError('Gagal menyimpan karena data \''. $isDataExist->keterangan_surat .'\' sudah tersimpan !');
        
        $statusSurat = StatusSurat::create([
            'keterangan_surat' => $request->keterangan_surat
        ]);
        return $this->sendResponse([
            'status_surat' => [new StatusSuratResource($statusSurat)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusSurat  $statusSurat
     * @return \Illuminate\Http\Response
     */
    public function show(StatusSurat $statusSurat)
    {
        if($statusSurat) return $this->sendResponse([
            'status_surat' => new StatusSuratResource($statusSurat)
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusSurat  $statusSurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusSurat $statusSurat)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_status_surat' => 'required',
            'keterangan_surat' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $statusSurat = StatusSurat::find($request->kd_status_surat);
        if(!$statusSurat){
            return $this->sendError('Data tidak ditemukan!');
        }

        $statusSurat->update($request->only(['keterangan_surat']));
        return $this->sendResponse([
            'status_surat' => [new StatusSuratResource($statusSurat)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusSurat  $statusSurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusSurat $statusSurat)
    {
        $statusSurat->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
