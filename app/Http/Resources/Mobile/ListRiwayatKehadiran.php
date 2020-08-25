<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\RiwayatJadwal;

class ListRiwayatKehadiran extends JsonResource
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
            'tanggal' => $this->tanggal,
            $this->mergeWhen($this->jadwal->count()!=0, function() {
                return [
                    'jadwal' => RiwayatJadwal::collection($this->jadwal)
                ];
            })
        ];
    }
}
