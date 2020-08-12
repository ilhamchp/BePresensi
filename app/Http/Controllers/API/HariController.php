<?php

namespace App\Http\Controllers\API;

use App\Hari;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HariCollection;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
class HariController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new HariCollection(Hari::all());
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
            'kd_hari' => 'required',
            'nama_hari' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $isDataExist = Hari::find($request->kd_hari);
        if($isDataExist){
            return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_hari .' sudah tersimpan !');
        }

        $hari = Hari::create([
            'kd_hari' => $request->kd_hari,
            'nama_hari' => $request->nama_hari
        ]);
        return $this->sendResponse([
            'hari' => [$hari]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function show(Hari $hari)
    {
        $hari = Hari::find($hari);
        if($hari){
            return new HariCollection($hari);
        }else return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hari $hari)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_hari' => 'required',
            'nama_hari' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $hari = Hari::find($request->kd_hari);
        if(!$hari){
            return $this->sendError('Data tidak ditemukan!');
        }
        $hari->update($request->only(['nama_hari']));
        return $this->sendResponse([
            'hari' => [$hari]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hari $hari)
    {
        $hari->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
