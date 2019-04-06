<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    protected $table = "product_properties";

    protected $fillable = [
        'value',
        'property_id',
        'product_id'
    ];
}