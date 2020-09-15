<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Ruang as RuangResource;

class ListJadwalMahasiswa extends JsonResource
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
            'ruang' => new RuangResource($this->ruang),
            'matakuliah' => $this->matakuliah,
            'dosen' => $this->dosen,
            'jenis_perkuliahan' => $this->jenis_perkuliahan,
            'sesi_presensi_dibuka' => (boolean) $this->sesi_presensi_dibuka,
            'toleransi_keterlambatan' => (integer) $this->toleransi_keterlambatan,
            $this->mergeWhen($this->kehadiran()->exists() && $this->kehadiran->count()!=0, function() {
                return [
                    'kehadiran' => 'hadir ' . $this->kehadiran->where('kd_status_presensi','H')->count() .
                    ' dari ' . $this->kehadiran->count() . ' sesi',
                    'sudah_presensi' => $this->kehadiran->first()->jam_presensi != $this->kehadiran->first()->jam_presensi_dibuka
                ];
            })
        ];
    }
}
