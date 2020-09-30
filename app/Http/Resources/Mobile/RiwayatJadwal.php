<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kehadiran as KehadiranResource;
use App\Http\Resources\KehadiranCollection;
class RiwayatJadwal extends JsonResource
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
            'kd_jadwal' => $this->kd_jadwal,
            'sesi_mulai' => $this->sesiMulai,
            'sesi_berakhir' => $this->sesiBerakhir,
            'ruang' => $this->ruang,
            'matakuliah' => $this->matakuliah,
            'dosen' => $this->dosen,
            'jenis_perkuliahan' => $this->jenis_perkuliahan,
            $this->mergeWhen($this->kehadiran()->exists() && $this->kehadiran->count()!=0, function() {
                return new KehadiranCollection($this->kehadiran);
            })
        ];
    }
}
