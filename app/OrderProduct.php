<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "order_products";

    protected $fillable = [
        "order_id",
        'product_id',
        'quantity',
        'product_price',
        'sum'
    ];

    /*******************/
    /* Relations block */
    /*******************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, "order_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    /***********************/
    /* end relations block */
    /***********************/

    /*******************/
    /* accessors block */
    /*******************/

    /**
     * @param $id
     * @return $this
     */
    public function setOrder($id)
    {
        $this->order_id = $id;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setProduct($id)
    {
        $this->product_id = $id;
        return $this;
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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPrice($value)
    {
        $this->product_price = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->product_price;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setSum($value)
    {
        $this->sum = $value;
        return $this;
    }

    /***********************/
    /* end accessors block */
    /***********************/
}
