<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";

    protected $fillable = [
        "name",
        "last_name",
        "phone",
        "email"
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id', 'id');
    }
}
