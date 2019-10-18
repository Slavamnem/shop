<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrderResource extends Resource
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
            'id'          => $this->id,
            'status_id'   => $this->status->name,
            'sum'         => $this->sum,
            'client_id'   => $this->client->name,
            'description' => $this->description,
        ];
    }
}
