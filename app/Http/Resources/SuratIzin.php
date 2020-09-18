<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StatusPresensiCollection;
use App\Http\Resources\MahasiswaCollection;
use App\Http\Resources\StatusSuratCollection;

use App\StatusPresensi;
use App\Mahasiswa;
use App\StatusSurat;

class SuratIzin extends JsonResource
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
            'kd_surat_izin' => $this->kd_surat_izin,
            'kd_jenis_izin' => $this->kd_jenis_izin,
            'nim' => $this->nim,
            'tgl_mulai' => (string) $this->tgl_mulai,
            'tgl_selesai' => (string) $this->tgl_selesai,
            'jam_mulai' => (string) $this->jam_mulai,
            'jam_selesai' => (string) $this->jam_selesai,
            'status_surat' => $this->status_surat,
            'catatan_surat' => $this->catatan_surat,
            'catatan_wali_dosen' => $this->catatan_wali_dosen,
            'foto_surat' => $this->foto_surat,
            $this->mergeWhen($this->jenisIzin()->exists() && $this->jenisIzin->count()!=0, function() {
                return [
                    'jenis_izin' => $this->jenisIzin
                ];
            }),
            $this->mergeWhen($this->mahasiswa()->exists() && $this->mahasiswa->count()!=0, function() {
                return [
                    'mahasiswa' => $this->mahasiswa
                ];
            }),
            $this->mergeWhen($this->statusSurat()->exists() && $this->statusSurat->count()!=0, function() {
                return [
                    'status_surat' => $this->statusSurat
                ];
            }),
            
        ];
    }
}
