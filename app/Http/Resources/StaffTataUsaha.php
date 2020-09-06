<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
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
            'id_user' => $this->id_user,
            'foto_staff' => $this->foto_staff,
            $this->mergeWhen($this->user()->exists() && $this->user->count()!=0, function() {
                return [
                    'user' => new UserResource($this->user)
                ];
            })
        ];
    }
}
