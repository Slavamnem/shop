<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelGroup extends Model
{
    protected $table = "model_groups";

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, "group_id", "id");
    }
}
