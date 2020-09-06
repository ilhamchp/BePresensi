<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dosen as DosenResource;
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
            'kd_wali_dosen' => $this->kd_wali_dosen,
            'nama_wali_dosen' => $this->waliDosen->nama_dosen,
            $this->mergeWhen($this->waliDosen()->exists() && $this->waliDosen->count()!=0, function() {
                return [
                    'wali_dosen' => new DosenResource($this->waliDosen)
                ];
            })
        ];
    }
}
