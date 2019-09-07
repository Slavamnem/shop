<?php

namespace App;

use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\ProductService;
use App\Services\Admin\ShareService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
            ->withPivot(['value', 'ordering'])->orderBy("ordering");
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

    public function getFullSlug()
    {
        return $this->category->slug . "_" . $this->slug . "_" . $this->id;
    }

    /***********************/
    /* end accessors block */
    /***********************/

    /***********************/
    /* extra methods block */
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

    /***************************/
    /* end extra methods block */
    /***************************/
}
