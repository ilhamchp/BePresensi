<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sesi extends JsonResource
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
            'kd_sesi' => $this->kd_sesi,
            'jam_mulai' => (string) $this->jam_mulai,
            'jam_berakhir' => (string) $this->jam_berakhir
        ];
    }
}
