<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeritaAcara extends JsonResource
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
            'kd_berita_acara' => $this->kd_berita_acara,
            'kd_jadwal' => [
                'jadwal' => $this->jadwal
            ],
            'desk_perkuliahan' => $this->desk_perkuliahan,
            'desk_penugasan' => $this->desk_penugasan,
            'tgl_pertemuan' => $this->tgl_pertemuan,
            'mhs_hadir' => $this->mhs_hadir,
            'mhs_tidak_hadir' => $this->mhs_tidak_hadir,
            'jam_presensi_dibuka' => $this->jam_presensi_dibuka,
            'jam_presensi_ditutup' => $this->jam_presensi_ditutup
        ];
    }
}
