<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\StaffTataUsaha;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\StaffTataUsahaCollection;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;

class StaffTataUsahaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StaffTataUsahaCollection(StaffTataUsaha::all());
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
            'kd_staff' => 'required|unique:App\StaffTataUsaha,kd_staff',
            'nama_staff' => 'required',
            'id_user' => 'required|unique:App\StaffTataUsaha,id_user|numeric|exists:App\User,id',
            'foto_staff' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $isDataExist = StaffTataUsaha::find($request->kd_staff);
        if($isDataExist){
            return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_staff .' sudah tersimpan !');
        }
        $user = User::find($request->id_user);
        if(!$user){
            return $this->sendError('Data user tidak ditemukan!');
        }
        $staff = new StaffTataUsaha;
        $staff->kd_staff = $request->kd_staff;
        $staff->nama_staff = $request->nama_staff;
        $staff->foto_staff = $request->foto_staff;
        $staff->user()->associate($user);
        $staff->save();
        return $this->sendResponse([
            'staff' => [$staff]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaffTataUsaha  $staffTataUsaha
     * @return \Illuminate\Http\Response
     */
    public function show(StaffTataUsaha $staffTataUsaha)
    {
        $staffTataUsaha = StaffTataUsaha::find($staffTataUsaha);
        if($staffTataUsaha) return new StaffTataUsahaCollection($staffTataUsaha);
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffTataUsaha  $staffTataUsaha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffTataUsaha $staffTataUsaha)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_staff' => 'required|exists:App\StaffTataUsaha,kd_staff',
            'nama_staff' => 'required',
            'id_user' => 'required|numeric|exists:App\User,id',
            'foto_staff' => 'required'
        ],$messages);
   
        if($validator->fails()){
            return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        }

        $staff = StaffTataUsaha::find($request->kd_staff);
        if(!$staff){
            return $this->sendError('Data tidak ditemukan!');
        }
        $staff->update([
            'nama_staff' => $request->nama_staff,
            'id_user' => $request->id_user,
            'foto_staff' => $request->foto_staff
        ]);
        return $this->sendResponse([
            'staff' => [$staff]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffTataUsaha  $staffTataUsaha
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffTataUsaha $staffTataUsaha)
    {
        $staffTataUsaha->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
