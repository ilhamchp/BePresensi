<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Ruang;
use Illuminate\Http\Request;
use App\Http\Resources\RuangCollection;
use App\Http\Resources\Ruang as RuangResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\Beacon;

class RuangController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RuangCollection(Ruang::all());
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
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_ruang' => 'required|unique:App\Ruang,kd_ruang',
            'nama_ruang' => 'required',
            'kd_beacon' => 'required|unique:App\Ruang,kd_beacon|exists:App\Beacon,kd_beacon'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        
        $isDataExist = Ruang::find($request->kd_ruang);
        if($isDataExist) return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_ruang .' sudah tersimpan !');
        
        $beacon = Beacon::find($request->kd_beacon);
        if(!$beacon) return $this->sendError('Data beacon tidak ditemukan!');
        
        $ruang = new Ruang;
        $ruang->kd_ruang = $request->kd_ruang;
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->beacon()->associate($beacon);
        $ruang->save();
        return $this->sendResponse([
            'ruang' => [new RuangResource($ruang)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function show(Ruang $ruang)
    {
        if($ruang) return $this->sendResponse([
            'ruang' => new RuangResource($ruang)
        ], 'success');
        return $this->sendError($ruang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruang $ruang)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'unique' => 'Atribut :attribute harus bersifat unik.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_ruang' => 'required',
            'nama_ruang' => 'required',
            'kd_beacon' => 'required|exists:App\Beacon,kd_beacon'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $isDataExist = Ruang::find($request->kd_ruang);
        if(!$isDataExist) return $this->sendError('Data tidak ditemukan!');
        
        $beacon = Beacon::find($request->kd_beacon);
        if(!$beacon) return $this->sendError('Data beacon tidak ditemukan!');
        
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->beacon()->associate($beacon);
        $ruang->save();
        return $this->sendResponse([
            'ruang' => [new RuangResource($ruang)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruang $ruang)
    {
        $ruang->delete();
        return $this->sendResponse(null,'Berhasil menghapus data!');
    }
}
