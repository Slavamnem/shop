<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = "baskets";

    protected $fillable = ["client_id", "city_id", "weight", "status"];

    /*******************/
    /* Relations block */
    /*******************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, "id", "client_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne(City::class, "id", "city_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(BasketProduct::class, "basket_id", "id");
    }

    /***********************/
    /* end relations block */
    /***********************/

    /*******************/
    /* accessors block */
    /*******************/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $cityId
     * @return $this
     */
    public function setCity($cityId)
    {
        $this->city_id = $cityId;
        return $this;
    }

    /**
     * @param $clientId
     * @return $this
     */
    public function setClient($clientId)
    {
        $this->client_id = $clientId;
        return $this;
    }

    /***********************/
    /* end accessors block */
    /***********************/
}
