<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
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
            'id_user' => $this->id_user,
            'foto_dosen' => $this->foto_dosen,
            $this->mergeWhen($this->user()->exists() && $this->user->count()!=0, function() {
                return [
                    'user' => new UserResource($this->user)
                ];
            })
        ];
    }
}
