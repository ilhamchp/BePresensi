<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MahasiswaCollection;
use App\Http\Resources\JadwalCollection;
use App\Http\Resources\SesiCollection;
use App\Http\Resources\StatusPresensiCollection;
use App\Http\Resources\SuratIzinCollection;
use App\Mahasiswa;
use App\Jadwal;
use App\Sesi;
use App\StatusPresensi;
use App\SuratIzin;

class Kehadiran extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'kd_kehadiran' => $this->kd_kehadiran,
            'nim'=> $this->nim,
            'kd_jadwal'=> $this->kd_jadwal,
            'kd_sesi'=> $this->kd_sesi,
            'kd_status_presensi'=> $this->kd_status_presensi,
            'kd_surat_izin'=> $this->kd_surat_izin,
            'tgl_presensi'=> $this->tgl_presensi,
            'jam_presensi'=> $this->jam_presensi,
            'jam_presensi_dibuka' => $this->jam_presensi_dibuka,
            $this->mergeWhen($this->mahasiswa()->exists() && $this->mahasiswa->count()!=0, function() {
                return [
                    'mahasiswa' => $this->mahasiswa
                ];
            }),
            $this->mergeWhen($this->jadwal()->exists() && $this->jadwal->count()!=0, function() {
                return [
                    'jadwal' => $this->jadwal
                ];
            }),
            $this->mergeWhen($this->sesi()->exists() && $this->sesi->count()!=0, function() {
                return [
                    'sesi' => $this->sesi
                ];
            }),
            $this->mergeWhen($this->statusPresensi()->exists() && $this->statusPresensi->count()!=0, function() {
                return [
                    'status_presensi' => $this->statusPresensi
                ];
            }),
            $this->mergeWhen($this->suratIzin()->exists() && $this->suratIzin->count()!=0, function() {
                return [
                    'surat_izin' => $this->suratIzin
                ];
            }),
        ];
    }
}
