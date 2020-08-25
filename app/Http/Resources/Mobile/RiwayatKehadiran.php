<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatKehadiran extends JsonResource
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
            'kd_status_presensi' => $this->kd_status_presensi
        ];
    }
}
