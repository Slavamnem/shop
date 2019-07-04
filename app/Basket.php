<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = "basket";

    protected $fillable = ["client_id", "city_id", "weight", "status"];

    public function client()
    {
        return $this->hasOne(Client::class, "id", "client_id");
    }

    public function city()
    {
        return $this->hasOne(City::class, "id", "city_id");
    }

    public function products()
    {
        return $this->hasMany(BasketProduct::class, "basket_id", "id");
    }
}
