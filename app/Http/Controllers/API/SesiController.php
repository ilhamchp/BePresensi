<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sesi;
use Illuminate\Http\Request;
use App\Http\Resources\SesiCollection;
use App\Http\Resources\Sesi as SesiResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;

class SesiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SesiCollection(Sesi::all());
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
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after' => 'Atribut :attribute tidak valid.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_sesi' => 'required|unique:App\Sesi,kd_sesi',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_berakhir' => 'required|date_format:H:i:s|after:jam_mulai'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $isDataExist = Sesi::find($request->kd_sesi);
        if($isDataExist){
            return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_sesi .' sudah tersimpan !');
        }

        $sesi = Sesi::create([
            'kd_sesi' => $request->kd_sesi,
            'jam_mulai' => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir
        ]);
        return $this->sendResponse([
            'sesi' => [new SesiResource($sesi)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function show(Sesi $sesi)
    {
        if($sesi) return $this->sendResponse([
            'sesi' => [new SesiResource($sesi)]
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesi $sesi)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after' => 'Atribut :attribute tidak valid.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_sesi' => 'required|exists:App\Sesi,kd_sesi',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_berakhir' => 'required|date_format:H:i:s|after:jam_mulai'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $sesi = Sesi::find($request->kd_sesi);
        if(!$sesi){
            return $this->sendError('Data tidak ditemukan!');
        }
        $sesi->update([
            'jam_mulai' => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir
        ]);
        return $this->sendResponse([
            'sesi' => [new SesiResource($sesi)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sesi $sesi)
    {
        $sesi->delete();
        return $this->sendResponse(null,'Berhasil menghapus data!');
    }
}
