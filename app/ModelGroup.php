<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelGroup extends Model
{
    protected $table = "model_groups";

    protected $fillable = [
        'name',
        'category_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, "group_id", "id");
    }

    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
}
