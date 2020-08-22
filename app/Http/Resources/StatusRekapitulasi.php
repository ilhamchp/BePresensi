<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusRekapitulasi extends JsonResource
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
            'kd_status_rekapitulasi' => $this->kd_status_rekapitulasi,
            'keterangan_rekapitulasi' => $this->keterangan_rekapitulasi
        ];
    }
}
