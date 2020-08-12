<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Matakuliah extends JsonResource
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
            'kd_matakuliah' => $this->kd_matakuliah,
            'nama_matakuliah' => $this->nama_matakuliah
        ];
    }
}
