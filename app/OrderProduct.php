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

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id", "id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
