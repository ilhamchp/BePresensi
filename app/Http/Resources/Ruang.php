<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BeaconCollection;
use App\Beacon;

class Ruang extends JsonResource
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
            'kd_ruang' => $this->kd_ruang,
            'nama_ruang' => $this->nama_ruang,
            'kd_beacon' => $this->kd_beacon,
            $this->mergeWhen($this->beacon()->exists() && $this->beacon->count()!=0, function() {
                return [
                    'beacon' => $this->beacon
                ];
            })
        ];
    }
}
