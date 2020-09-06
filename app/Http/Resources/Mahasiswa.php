<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kelas as KelasResource;
use App\Http\Resources\User as UserResource;
use App\User;
use App\Kelas;

class Mahasiswa extends JsonResource
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
            'nim' => $this->nim,
            'nama_mahasiswa' => $this->nama_mahasiswa,
            'id_user' => $this->id_user,
            'kd_kelas' => $this->kd_kelas,
            'foto_mahasiswa' => $this->foto_mahasiswa,
            'device_imei' => $this->device_imei,
            $this->mergeWhen($this->kelas()->exists() && $this->kelas->count()!=0, function() {
                return [
                    'kelas' => new KelasResource($this->kelas)
                ];
            }),
            $this->mergeWhen($this->user()->exists() && $this->user->count()!=0, function() {
                return [
                    'user' => new UserResource($this->user)
                ];
            })
        ];
    }
}
