<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailRiwayatKehadiran extends JsonResource
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
            'kd_sesi' => $this->kd_sesi,
            'status_presensi'=> $this->statusPresensi,
            'tgl_presensi'=> $this->tgl_presensi,
            'jam_presensi'=> $this->jam_presensi,
            'jam_presensi_dibuka' => $this->jam_presensi_dibuka,
            'kd_surat_izin' => $this->kd_surat_izin
        ];
    }
}
