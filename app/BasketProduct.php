<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    protected $table = "basket_products";

    protected $fillable = ['basket_id', 'product_id', 'quantity', 'price'];

    public function basket()
    {
        return $this->belongsTo(Basket::class, "basket_id", "id");
    }
}
