<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'url',
        'main',
        'preview',
        'ordering',
        'product_id'
    ];
}
