<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dump($request->all());
        return [
            "id"    => $this->id,
            "name"  => $this->name,
            "login" => $this->login,
            "email" => $this->email,
        ];
        //return parent::toArray($request);
    }
}
