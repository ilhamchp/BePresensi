<?php

namespace App\Http\Controllers\API;

use App\Beacon;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BeaconCollection;
use App\Http\Resources\Beacon as BeaconResource;
use Validator;
use Illuminate\Support\Arr;

class BeaconController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BeaconCollection(Beacon::all());
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
            'kd_beacon' => 'required',
            'mac_address' => 'required',
            'major' => 'required',
            'minor' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $isDataExist = Beacon::find($request->kd_beacon);
        if($isDataExist) return $this->sendError('Gagal menyimpan karena data '. $isDataExist->kd_beacon .' sudah tersimpan !');

        $beacon = Beacon::create([
            'kd_beacon' => $request->kd_beacon,
            'mac_address'=> $request->mac_address,
            'major' => $request->major,
            'minor' => $request->minor
        ]);
        return $this->sendResponse([
            'beacon' => [new BeaconResource($beacon)]
        ], 'Berhasil menyimpan data !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beacon  $beacon
     * @return \Illuminate\Http\Response
     */
    public function show(Beacon $beacon)
    {
        if($beacon) return $this->sendResponse([
            'beacon' => new BeaconResource($beacon)
        ], 'Berhasil memperbaharui data !');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beacon  $beacon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beacon $beacon)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_beacon' => 'required',
            'mac_address' => 'required',
            'major' => 'required',
            'minor' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal. ', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $beacon = Beacon::find($request->kd_beacon);
        if(!$beacon) return $this->sendError('Data tidak ditemukan!');
        
        $beacon->update($request->only(['mac_address', 'major','minor']));
        return $this->sendResponse([
            'beacon' => [new BeaconResource($beacon)]
        ], 'Berhasil memperbaharui data !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beacon  $beacon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beacon $beacon)
    {
        $beacon->delete();
        return $this->sendResponse(null,'Berhasil hapus data!');
    }
}
