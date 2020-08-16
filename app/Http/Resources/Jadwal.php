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
            // 'kd_kelas' => new KelasCollection(Kelas::find($this->kelas)),
            'kd_kelas' => [
                'kelas' => $this->kelas
            ],
            'kd_hari' => new HariCollection(Hari::find($this->hari)),
            'kd_sesi_mulai' => [
                'sesi' => [new SesiResource($this->sesiMulai)]
            ],
            'kd_sesi_berakhir' => [
                'sesi' => [new SesiResource($this->sesiBerakhir)]
            ],
            'kd_ruang' => new RuangCollection(Ruang::find($this->ruang)),
            'kd_matakuliah' => new MatakuliahCollection(Matakuliah::find($this->matakuliah)),
            // 'kd_dosen_pengajar' => new DosenCollection(Dosen::find($this->dosen)),
            'kd_dosen_pengajar' => [
                'dosen' => $this->dosen
            ],
            'jenis_perkuliahan' => $this->jenis_perkuliahan,
            'sesi_presensi_dibuka' => (boolean) $this->sesi_presensi_dibuka,
            'toleransi_keterlambatan' => (integer) $this->toleransi_keterlambatan
        ];
    }
}
