<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserCollection;
use App\User;
class StaffTataUsaha extends JsonResource
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
            'kd_staff' => $this->kd_staff,
            'nama_staff' => $this->nama_staff,
            'id_user' => new UserCollection(User::find($this->user)),
            'foto_staff' => $this->foto_staff
        ];
    }
}
