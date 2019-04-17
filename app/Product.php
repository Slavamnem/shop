<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        'name',
        'slug',
        'base_price',
        'quantity',
        'category_id',
        'description',
        'group_id',
        'status_id',
        'color_id',
        'size_id'
    ];

    private $fieldsTranslations = [
        'id' => 'Id',
        'name' => 'Имя',
        'slug' => 'Слаг',
        'base_price' => 'Цена',
        'quantity' => 'Количество',
        'category_id' => 'Категория',
        'description' => 'Описание',
        'group_id' => 'Группа',
        'status_id' => 'Статус',
        'color_id' => 'Цвет',
        'size_id' => 'Размер',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function group()
    {
        return $this->belongsTo(ModelGroup::class, "group_id", "id");
    }

    public function status()
    {
        return $this->hasOne(ProductStatus::class, "id", "status_id");
    }

    public function color()
    {
        return $this->hasOne(Color::class, "id", "color_id");
    }

    public function size()
    {
        return $this->hasOne(Size::class, "id", "size_id");
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, "product_properties","product_id", "property_id")
            ->withPivot(['value', 'ordering'])->orderBy("ordering");
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, "product_id", 'id');
    }

    public static function getImagesAttributesKeys()
    {
        return ["image", "small_image"];
    }

    public static function getModificationsAttributes()
    {
        return [
            "colors" => Color::class,
            "sizes" => Size::class
        ];
    }

    public function getFieldsTranslations()
    {
        return $this->fieldsTranslations;
    }
}
