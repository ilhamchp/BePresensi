<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListJadwalDosenCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'jadwal' => $this->collection
        ];
    }
}
