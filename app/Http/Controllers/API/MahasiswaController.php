<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Resources\MahasiswaCollection;
use App\Http\Resources\Mahasiswa as MahasiswaResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\User;
use App\Kelas;


class MahasiswaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new MahasiswaCollection(Mahasiswa::all());
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
            'nim' => 'required|unique:App\Mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'kd_kelas' => 'required|exists:App\Kelas,kd_kelas',
            'id_user' => 'required|unique:App\Mahasiswa,id_user|numeric|exists:App\User,id',
            'foto_mahasiswa' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $isDataExist = Mahasiswa::find($request->nim);
        if($isDataExist) return $this->sendError('Gagal menyimpan karena data '. $isDataExist->nim .' sudah tersimpan !');

        $user = User::find($request->id_user);
        if(!$user) return $this->sendError('Data user tidak ditemukan!');

        $kelas = Kelas::find($request->kd_kelas);
        if(!$user) return $this->sendError('Data kelas tidak ditemukan!');

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->foto_mahasiswa = $request->foto_mahasiswa;
        if($request->device_imei) $mahasiswa->device_imei = $request->device_imei;
        $mahasiswa->user()->associate($user);
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        return $this->sendResponse([
            'mahasiswa' => [new MahasiswaResource($mahasiswa)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        if($mahasiswa) return $this->sendResponse([
            'mahasiswa' => [new MahasiswaResource($mahasiswa)]
        ], 'Berhasil memperbaharui data!');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'unique' => 'Atribut :attribute harus bersifat unik.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'kd_kelas' => 'required|exists:App\Kelas,kd_kelas',
            'id_user' => 'required|numeric|exists:App\User,id',
            'foto_mahasiswa' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $user = User::find($request->id_user);
        if(!$user) return $this->sendError('Data user tidak ditemukan!');

        $kelas = Kelas::find($request->kd_kelas);
        if(!$kelas) return $this->sendError('Data kelas tidak ditemukan!');

        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->foto_mahasiswa = $request->foto_mahasiswa;
        $mahasiswa->user()->associate($user);
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->update();

        return $this->sendResponse([
            'mahasiswa' => [new MahasiswaResource($mahasiswa)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return $this->sendResponse(null,'Berhasil menghapus data!');
    }
}
