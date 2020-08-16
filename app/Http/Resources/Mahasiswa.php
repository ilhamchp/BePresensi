<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KelasCollection;
use App\Http\Resources\UserCollection;
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
            'id_user' => new UserCollection(User::find($this->user)),
            // 'kd_kelas' => new KelasCollection(Kelas::find($this->kelas)),
            'kd_kelas' => [
                'kelas' => $this->kelas
            ],
            'foto_mahasiswa' => $this->foto_mahasiswa,
            'device_imei' => $this->device_imei
        ];
    }
}
