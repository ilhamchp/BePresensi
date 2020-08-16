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
            'nim'=> [
                'mahasiswa' => $this->mahasiswa
            ],
            'kd_jadwal'=> [
                'jadwal' => $this->jadwal
            ],
            'kd_sesi'=> [
                'sesi' => $this->sesi
            ],
            'kd_status_presensi'=> new StatusPresensiCollection(StatusPresensi::find($this->statusPresensi)),
            'kd_surat_izin'=> [
                'surat_izin' => $this->suratIzin
            ],
            'tgl_presensi'=> $this->tgl_presensi,
            'jam_presensi'=> $this->jam_presensi
        ];
    }
}
