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

    public function product()
    {
        return $this->hasOne(Product::class, "id", "product_id");
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->product->name;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->attributes['quantity'];
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->attributes['price'];
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->getPrice() * $this->getQuantity();
    }
}
