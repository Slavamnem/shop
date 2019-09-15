<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    protected $table = "product_properties";

    protected $fillable = [
        'property_id',
        'product_id',
        'property_value_id'
    ];
}
