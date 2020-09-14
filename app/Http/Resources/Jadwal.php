<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KelasCollection;
use App\Http\Resources\HariCollection;
use App\Http\Resources\Sesi as SesiResource;
use App\Http\Resources\RuangCollection;
use App\Http\Resources\MatakuliahCollection;
use App\Http\Resources\DosenCollection;

use App\Kelas;
use App\Hari;
use App\Sesi;
use App\Ruang;
use App\Matakuliah;
use App\Dosen;
class Jadwal extends JsonResource
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
            'kd_kelas' => $this->kd_kelas,
            'kd_hari' => $this->kd_hari,
            'sesi_mulai' => $this->sesiMulai,
            'sesi_berakhir' => $this->sesiBerakhir,
            'kd_ruang' => $this->kd_ruang,
            'kd_matakuliah' => $this->kd_matakuliah,
            'kd_dosen_pengajar' => $this->kd_dosen_pengajar,
            'jenis_perkuliahan' => $this->jenis_perkuliahan,
            'sesi_presensi_dibuka' => (boolean) $this->sesi_presensi_dibuka,
            'toleransi_keterlambatan' => (integer) $this->toleransi_keterlambatan,
            'jam_presensi_dibuka' => (string) $this->jam_presensi_dibuka,
            $this->mergeWhen($this->kelas()->exists() && $this->kelas->count()!=0, function() {
                return [
                    'kelas' => $this->kelas
                ];
            }),
            $this->mergeWhen($this->hari()->exists() && $this->hari->count()!=0, function() {
                return [
                    'hari' => $this->hari
                ];
            }),
            $this->mergeWhen($this->ruang()->exists() && $this->ruang->count()!=0, function() {
                return [
                    'ruang' => $this->ruang
                ];
            }),
            $this->mergeWhen($this->matakuliah()->exists() && $this->matakuliah->count()!=0, function() {
                return [
                    'matakuliah' => $this->matakuliah
                ];
            }),
            $this->mergeWhen($this->dosen()->exists() && $this->dosen->count()!=0, function() {
                return [
                    'dosen' => $this->dosen
                ];
            }),
        ];
    }
}
