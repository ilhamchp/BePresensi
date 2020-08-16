<?php

namespace App\Http\Controllers\API;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DosenCollection;
use App\Http\Resources\Dosen as DosenResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\User;

class DosenController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DosenCollection(Dosen::all());
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
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_dosen' => 'required|unique:App\Dosen,kd_dosen',
            'nama_dosen' => 'required',
            'id_user' => 'required|unique:App\Dosen,id_user|numeric|exists:App\User,id',
            'foto_dosen' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $isDataExist = Dosen::find($request->kd_dosen);
        if($isDataExist) return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_dosen .' sudah tersimpan !');
        
        $user = User::find($request->id_user);
        if(!$user) return $this->sendError('Data user tidak ditemukan!');
        
        $dosen = new Dosen;
        $dosen->kd_dosen = $request->kd_dosen;
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->foto_dosen = $request->foto_dosen;
        $dosen->user()->associate($user);
        $dosen->save();
        return $this->sendResponse([
            'dosen' => [new DosenResource($dosen)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        if($dosen) return $this->sendResponse([
            'dosen' => [new DosenResource($dosen)]
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_dosen' => 'required',
            'nama_dosen' => 'required',
            'id_user' => 'required|numeric|exists:App\User,id',
            'foto_dosen' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $dosen = Dosen::find($request->kd_dosen);
        if(!$dosen) return $this->sendError('Data tidak ditemukan!');
        
        $dosen->update([
            'nama_dosen' => $request->nama_dosen,
            'id_user' => $request->id_user,
            'foto_dosen' => $request->foto_dosen
        ]);
        return $this->sendResponse([
            'dosen' => [new DosenResource($dosen)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return $this->sendResponse(null,'Berhasil menghapus data!');
    }
}
