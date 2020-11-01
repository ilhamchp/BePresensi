<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Ruang as RuangResource;
use App\Http\Resources\BeritaAcara as BeritaAcaraResource;

class ListJadwalDosen extends JsonResource
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
            'sesi_mulai' => $this->sesiMulai,
            'sesi_berakhir' => $this->sesiBerakhir,
            'ruang' => new RuangResource($this->ruang),
            'matakuliah' => $this->matakuliah,
            'dosen' => $this->dosen,
            'jenis_perkuliahan' => $this->jenis_perkuliahan,
            'sesi_presensi_dibuka' => (boolean) $this->sesi_presensi_dibuka,
            'toleransi_keterlambatan' => (integer) $this->toleransi_keterlambatan,
            'jam_presensi_dibuka' => (string) $this->jam_presensi_dibuka,
            'jam_presensi_ditutup' => (string) $this->jam_presensi_ditutup,
            $this->mergeWhen($this->beritaAcara()->exists() && $this->beritaAcara->count()!=0, function() {
                return [
                    'berita_acara' => $this->beritaAcara[0]
                ];
            }),
            $this->mergeWhen((!$this->beritaAcara()->exists()) && $this->beritaAcara->count()==0, function() {
                return [
                    'berita_acara' => null
                ];
            }),
            $this->mergeWhen($this->hari()->exists() && $this->hari->count()!=0, function() {
                return [
                    'hari' => $this->hari
                ];
            }),
            $this->mergeWhen($this->kehadiran()->exists() && $this->kehadiran->count()!=0, function() {
                return [
                    'status_hadir' => $this->kehadiran->where('kd_status_presensi','H')->unique('nim')->count()
                    . " dari ". $this->kehadiran->unique('nim')->count()
                    . " mahasiswa hadir."
                    ];
            }),
            $this->mergeWhen((!$this->kehadiran()->exists()) && $this->kehadiran->count()==0, function() {
                return [
                    'status_hadir' => null
                ];
            })
        ];
    }
}
