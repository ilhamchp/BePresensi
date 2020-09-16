<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rekapitulasi;
use Illuminate\Http\Request;
use App\Http\Resources\RekapitulasiCollection;
use App\Http\Resources\Rekapitulasi as RekapitulasiResource;
use App\Http\Resources\Mobile\RekapitulasiKehadiran;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Mahasiswa;
use App\Kehadiran;
use Illuminate\Support\Arr;

class RekapitulasiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RekapitulasiCollection(Rekapitulasi::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->sendError('Tidak dapat melakukan input manual data rekapitulasi, silahkan pilih menu "Reload Data Rekapitulasi" atau "Refresh Data Rekapitulasi"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function show(Rekapitulasi $rekapitulasi)
    {
        if($rekapitulasi) return $this->sendResponse([
            'rekapitulasi' => [new RekapitulasiResource($rekapitulasi)]
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function detailRekapKehadiran(Rekapitulasi $rekapitulasi)
    {
        if($rekapitulasi){
            $rekapitulasi->sakit = Kehadiran::where('nim',$rekapitulasi->nim)->where('kd_status_presensi','S')->count();
            $rekapitulasi->izin = Kehadiran::where('nim',$rekapitulasi->nim)->where('kd_status_presensi','I')->count();
            $rekapitulasi->alfa = Kehadiran::where('nim',$rekapitulasi->nim)->where('kd_status_presensi','A')->count();
            $alfa = $rekapitulasi->alfa;
            if($alfa<10){
                $rekapitulasi->kd_status_rekapitulasi = 'OK';
            }else if($alfa>10 && $alfa<19){
                $rekapitulasi->kd_status_rekapitulasi = 'SP1';
            }else if($alfa>19 && $alfa<29){
                $rekapitulasi->kd_status_rekapitulasi = 'SP2';
            }else if($alfa>29 && $alfa<38){
                $rekapitulasi->kd_status_rekapitulasi = 'SP3';
            }else if($alfa>38){
                $rekapitulasi->kd_status_rekapitulasi = 'DO';
            }
            $rekapitulasi->update();

            return $this->sendResponse([
                'rekapitulasi' => new RekapitulasiKehadiran($rekapitulasi)
            ], 'success');
        }else return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekapitulasi $rekapitulasi)
    {
        return $this->sendError('Tidak dapat melakukan update manual data rekapitulasi, silahkan pilih menu Refresh Data Rekapitulasi"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekapitulasi  $rekapitulasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekapitulasi $rekapitulasi)
    {
        return $this->sendError('Tidak dapat melakukan hapus rekapitulasi, silahkan pilih menu "Reload Data Rekapitulasi"');
    }

    /**
     * Melakukan pembuatan kembali data rekapitulasi
     * sesuai dengan data pada tabel mahasiswa.
     * 
     * @return \Illuminate\Http\Response
     */
    public function reloadDataRekapitulasi()
    {
        Rekapitulasi::truncate();
        $mahasiswa = Mahasiswa::all();
        foreach($mahasiswa as $mhs){
            Rekapitulasi::create([
                'nim' => $mhs->nim,
                'sakit' => 0,
                'izin' => 0,
                'alfa' => 0,
                'kd_status_rekapitulasi' => 'OK'
            ]);
        }
        return $this->sendResponse(null,'Berhasil reload data rekapitulasi!');
    }

    /**
     * Melakukan penghitungan data rekapitulasi
     * sesuai dengan data pada tabel kehadiran.
     * 
     * @return \Illuminate\Http\Response
     */
    public function refreshDataRekapitulasi()
    {
        $mahasiswa = Mahasiswa::all();
        foreach($mahasiswa as $mhs){
            $rekapitulasi = Rekapitulasi::findOrFail($mhs->nim);
            if($rekapitulasi){
                $rekapitulasi->sakit = Kehadiran::where('nim',$mhs->nim)->where('kd_status_presensi','S')->count();
                $rekapitulasi->izin = Kehadiran::where('nim',$mhs->nim)->where('kd_status_presensi','I')->count();
                $rekapitulasi->alfa = Kehadiran::where('nim',$mhs->nim)->where('kd_status_presensi','A')->count();
                $alfa = $rekapitulasi->alfa;
                if($alfa<10){
                    $rekapitulasi->kd_status_rekapitulasi = 'OK';
                }else if($alfa>10 && $alfa<19){
                    $rekapitulasi->kd_status_rekapitulasi = 'SP1';
                }else if($alfa>19 && $alfa<29){
                    $rekapitulasi->kd_status_rekapitulasi = 'SP2';
                }else if($alfa>29 && $alfa<38){
                    $rekapitulasi->kd_status_rekapitulasi = 'SP3';
                }else if($alfa>38){
                    $rekapitulasi->kd_status_rekapitulasi = 'DO';
                }
                $rekapitulasi->update();
            }
        }
        return $this->sendResponse(null,'Berhasil refresh data rekapitulasi!');
    }
}
