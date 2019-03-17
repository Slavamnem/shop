<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'name',
        'slug',
        'base_price',
        'quantity',
        'category_id',
        'description',
        'image',
        'small_image',
        'group',
        'status',
        'color_id',
        'size_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function color()
    {
        return $this->hasOne(Color::class, "id", "color_id");
    }

    public function size()
    {
        return $this->hasOne(Size::class, "id", "size_id");
    }
}
