<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;
use App\Http\Resources\KelasCollection;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\Dosen;

class KelasController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new KelasCollection(Kelas::all());
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
            'kd_kelas' => 'required|unique:App\Kelas,kd_kelas',
            'tingkat_kelas' => 'required|numeric',
            'prodi' => 'required',
            'angkatan' => 'required|numeric',
            'kd_wali_dosen' => 'required|unique:App\Kelas,kd_wali_dosen|exists:App\Dosen,kd_dosen'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $isDataExist = Kelas::find($request->kd_kelas);
        if($isDataExist){
            return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_kelas .' sudah tersimpan !');
        }
        $dosen = Dosen::find($request->kd_wali_dosen);
        if(!$dosen){
            return $this->sendError('Data dosen tidak ditemukan!');
        }
        $kelas = new Kelas;
        $kelas->kd_kelas = $request->kd_kelas;
        $kelas->tingkat_kelas = $request->tingkat_kelas;
        $kelas->prodi = $request->prodi;
        $kelas->angkatan = $request->angkatan;
        $kelas->waliDosen()->associate($dosen);
        $kelas->save();
        return $this->sendResponse([
            'kelas' => [$kelas]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        $kelas = Kelas::find($kelas);
        if($kelas) return new KelasCollection($kelas);
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'unique' => 'Atribut :attribute harus bersifat unik.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_kelas' => 'required',
            'tingkat_kelas' => 'required|numeric',
            'prodi' => 'required',
            'angkatan' => 'required|numeric',
            'kd_wali_dosen' => 'required|exists:App\Dosen,kd_dosen'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $dosen = Dosen::find($request->kd_wali_dosen);
        if(!$dosen) return $this->sendError('Data tidak ditemukan!');

        $kelas->tingkat_kelas = $request->tingkat_kelas;
        $kelas->prodi = $request->prodi;
        $kelas->angkatan = $request->angkatan;
        $kelas->waliDosen()->associate($dosen);
        $kelas->update();

        return $this->sendResponse([
            'kelas' => [$kelas]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
