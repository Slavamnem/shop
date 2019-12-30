<?php

namespace App;

use App\Components\Graphics\Interfaces\GraphicResourceItem;
use App\Enums\OrderStatusEnum;
use App\Traits\GraphicResourceItemTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Order
 * @package App
 * @property int id
 * @property int status_id
 * @property double sum
 * @property int client_id
 * @property string description
 * @property int payment_type_id
 * @property int delivery_type_id
 * @property string city
 * @property string warehouse
 * @property int basket_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Order extends Model implements GraphicResourceItem
{
    use Notifiable, GraphicResourceItemTrait;

    /**
     * @var string
     */
    protected $table = "orders";
    /**
     * @var array
     */
    protected $fillable = [
        "status_id",
        "sum",
        "client_id",
        "description",
        "payment_type_id",
        "delivery_type_id",
        "city",
        "warehouse",
        "basket_id"
    ];

    /*******************/
    /* Relations block */
    /*******************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(OrderStatus::class, "id", "status_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery_type()
    {
        return $this->hasOne(DeliveryType::class, "id", "delivery_type_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment_type()
    {
        return $this->hasOne(PaymentType::class, "id", "payment_type_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class, "order_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, "client_id", "id");
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
     * @param $id
     * @return $this
     */
    public function setStatus($id)
    {
        $this->status_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setSum($value)
    {
        $this->sum = $value;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setClient($id)
    {
        $this->client_id = $id;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setDescription($value)
    {
        $this->description = $value;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setPaymentType($id)
    {
        $this->payment_type_id = $id;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setDeliveryType($id)
    {
        $this->delivery_type_id = $id;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCity($value)
    {
        $this->city = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setWarehouse($value)
    {
        $this->warehouse = $value;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setBasket($id)
    {
        $this->basket_id = $id;
        return $this;
    }

    /***********************/
    /* end accessors block */
    /***********************/

    /***********************/
    /* extra methods block */
    /***********************/

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisYear($query)
    {
        return $query->whereYear("created_at", Carbon::now()->year);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisMonth($query)
    {
        $now = Carbon::now();
        return $query->whereYear("created_at", $now->year)->whereMonth("created_at", $now->month);
    }

    /**
     * @return mixed
     */
    public function getStatusClass()
    {
        return (new OrderStatusEnum($this->getStatusId()))->getStatusClass();
    }

    public function __toString()
    {
        return $this->attributes[''];
    }

    /***************************/
    /* end extra methods block */
    /***************************/
}
