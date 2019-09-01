<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
      'pid',
      'name',
      'slug',
      'ordering',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, "category_id", "id");
    }

    /**
     * @return int
     */
    public function productsCount()
    {
        $total = $this->products()->count();

        foreach ($this->children as $subCategory)
        {
            $total += $subCategory->products->count();
        }

        return $total;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'pid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'pid', 'id');
    }
}
