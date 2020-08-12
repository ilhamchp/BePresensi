<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Beacon extends JsonResource
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
            'kd_beacon' => $this->kd_beacon,
            'mac_address'=> $this->mac_address,
            'major' => $this->major,
            'minor' => $this->minor
        ];
    }
}
