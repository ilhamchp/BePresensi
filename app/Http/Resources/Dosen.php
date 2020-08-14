<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserCollection;
use App\User;

class Dosen extends JsonResource
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
            'kd_dosen' => $this->kd_dosen,
            'nama_dosen' => $this->nama_dosen,
            'id_user' => new UserCollection(User::find($this->user)),
            'foto_dosen' => $this->foto_dosen
        ];
    }
}
