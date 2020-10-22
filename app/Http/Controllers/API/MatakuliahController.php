<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Matakuliah;
use Illuminate\Http\Request;
use App\Http\Resources\MatakuliahCollection;
use App\Http\Resources\Matakuliah as MatakuliahResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;


class MatakuliahController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new MatakuliahCollection(Matakuliah::all());
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
            'kd_matakuliah' => 'required',
            'nama_matakuliah' => 'required'
        ],$messages);
   
        if($validator->fails())return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        
        $isDataExist = Matakuliah::find($request->kd_matakuliah);
        if($isDataExist)return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_matakuliah .' sudah tersimpan !');
        
        $matakuliah = Matakuliah::create([
            'kd_matakuliah' => $request->kd_matakuliah,
            'nama_matakuliah' => $request->nama_matakuliah
        ]);
        return $this->sendResponse([
            'matakuliah' => [new MatakuliahResource($matakuliah)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function show(Matakuliah $matakuliah)
    {
        if($matakuliah) return $this->sendResponse([
            'matakuliah' => new MatakuliahResource($matakuliah)
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_matakuliah' => 'required',
            'nama_matakuliah' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        
        $matakuliah = Matakuliah::find($request->kd_matakuliah);
        if(!$matakuliah) return $this->sendError('Data tidak ditemukan!');
        
        $matakuliah->update($request->only(['nama_matakuliah']));
        return $this->sendResponse([
            'matakuliah' => [new MatakuliahResource($matakuliah)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
