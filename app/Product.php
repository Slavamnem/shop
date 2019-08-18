<?php

namespace App;

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

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class, "product_id", 'id')->where("main", true);
    }

//    public function sales() // unused
//    {
//        return DB::select(
//            "SELECT SUM(o.quantity) AS quantity, SUM(o.sum) AS total_sum
//            FROM products AS p
//            LEFT JOIN order_products AS o
//            ON o.product_id = p.id
//            WHERE p.id = {$this->attributes['id']}
//        ")[0];
//    }

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

//    public function getPrice()
//    {
//        $price = $this->attributes['base_price'];
//
//        ///
////        $products = Product::all();
//////
//////        $time1 = Carbon::now();
//////        foreach ($products as $product) {
//////            $productShare = ShareService::getProductShare($product);
//////        }
//////        $time2 = Carbon::now();
//////        dump($time2->diff($time1));
//        /////////////////
//
//        if ($productShare = ShareService::getProductShare($this)) {
//            if ($productShare->fix_price) {
//                $price = $productShare->fix_price;
//            } elseif ($productShare->discount) {
//                $price -= $price * ($productShare->discount / 100); //$price *= (100 - $productShare->discount) / 100;
//            }
//        }
//
//        return $price;
//    }

    public function orders()
    {
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
    }

}
