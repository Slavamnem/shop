<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, "product_properties", "property_id", "product_id");
    }
}
