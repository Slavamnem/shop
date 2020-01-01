<?php

namespace App;

use App\Services\Admin\Interfaces\ProductServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @property integer id
 * @property integer quantity
 * @property string slug
 * @property bool active
 * @package App
 */
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
        'size_id',
        'active'
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

    public static $relationsFilters = [
        "category_id" => "category",
        "group_id"    => "group",
        "status_id"   => "status",
        "color_id"    => "color",
        "size_id"     => "size"
    ];

    const FACET_ATTRIBUTES = [
        'color_id',
        'size_id'
    ];

    /*******************/
    /* Relations block */
    /*******************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(ModelGroup::class, "group_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(ProductStatus::class, "id", "status_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function color()
    {
        return $this->hasOne(Color::class, "id", "color_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function size()
    {
        return $this->hasOne(Size::class, "id", "size_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class, "product_properties","product_id", "property_id")
            ->withPivot(['property_value_id', 'ordering'])->orderBy("ordering");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function propertyValues()
    {
        return $this->belongsToMany(PropertyValue::class, "product_properties","product_id", "property_value_id")
            ->withPivot(['property_id', 'ordering']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, "product_id", 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class, "product_id", 'id')->where("main", true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
    }

    /***********************/
    /* end relations block */
    /***********************/

    /*******************/
    /* accessors block */
    /*******************/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getFullSlug()
    {
        return $this->category->slug . "_" . $this->slug . "_" . $this->id;
    }
    /***********************/
    /* end accessors block */
    /***********************/

    /***********************/
    /* extra methods block */ // TODO вынести отсюда в трейт или сервис
    /***********************/

    /**
     * @return float|int
     */
    public function getRealPriceAttribute()
    {
        return resolve(ProductServiceInterface::class)->getPrice($this);
    }

    /**
     * @return array
     */
    public static function getImagesAttributesKeys()
    {
        return ["image", "small_image"];
    }

    /**
     * @return array
     */
    public static function getModificationsAttributes()
    {
        return [
            "colors" => Color::class,
            "sizes" => Size::class
        ];
    }

    /**
     * @return array
     */
    public function getFieldsTranslations()
    {
        return $this->fieldsTranslations;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getFieldTranslation($key)
    {
        return array_get($this->fieldsTranslations, $key, null);
    }

    /***************************/
    /* end extra methods block */
    /***************************/
}
