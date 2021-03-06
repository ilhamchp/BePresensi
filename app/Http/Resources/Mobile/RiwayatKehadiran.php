<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StatusPresensi as StatusPresensiResource;

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
            'tgl_presensi' => $this->tgl_presensi,
            'kd_sesi' => $this->kd_sesi,
            'kd_status_presensi' => $this->kd_status_presensi,
            $this->mergeWhen($this->statusPresensi()->exists() && $this->statusPresensi->count()!=0, function() {
                return [
                    'status_presensi' => new StatusPresensiResource($this->statusPresensi)
                ];
            })
        ];
    }
}
