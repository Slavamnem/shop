<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    protected $table = "basket_products";

    protected $fillable = ['basket_id', 'product_id', 'quantity', 'price'];

    /*******************/
    /* Relations block */
    /*******************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function basket()
    {
        return $this->belongsTo(Basket::class, "basket_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, "id", "product_id");
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
     * @param $value
     * @return $this
     */
    public function setQuantity($value)
    {
        $this->quantity = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->attributes['price'];
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPrice($value)
    {
        $this->price = $value;
        return $this;
    }

    /**
     * @param $productId
     * @return $this
     */
    public function setProduct($productId)
    {
        $this->product_id = $productId;
        return $this;
    }

    /***********************/
    /* end accessors block */
    /***********************/

    /***********************/
    /* extra methods block */
    /***********************/

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->getPrice() * $this->getQuantity();
    }

    /***************************/
    /* end extra methods block */
    /***************************/
}
