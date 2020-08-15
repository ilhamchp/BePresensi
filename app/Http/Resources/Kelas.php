<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DosenCollection;
use App\Dosen;
class Kelas extends JsonResource
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
            'kd_kelas' => $this->kd_kelas,
            'tingkat_kelas' => $this->tingkat_kelas,
            'prodi' => $this->prodi,
            'angkatan' => $this->angkatan,
            'kd_wali_dosen' => new DosenCollection(Dosen::find($this->waliDosen))
        ];
    }
}
