<?php

namespace App;

use App\Enums\OrderStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $table = "orders";

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

    public function status()
    {
        return $this->hasOne(OrderStatus::class, "id", "status_id");
    }

    public function delivery_type()
    {
        return $this->hasOne(DeliveryType::class, "id", "delivery_type_id");
    }

    public function payment_type()
    {
        return $this->hasOne(PaymentType::class, "id", "payment_type_id");
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, "order_id", "id");
    }

    public function client()
    {
        return $this->belongsTo(Client::class, "client_id", "id");
    }

    public function scopeThisMonth($query)
    {
        $now = Carbon::now();
        return $query->whereYear("created_at", $now->year)->whereMonth("created_at", $now->month);
    }

    /**
     * @return mixed
     */
    public function statusClass()
    {
        $statuses = [
            OrderStatusEnum::WAIT_FOR_PAYMENT => "alert-warning",
            OrderStatusEnum::PAID             => "alert-success",
            OrderStatusEnum::CANCELED         => "alert-danger",
        ];

        return $statuses[$this->attributes["status_id"]];
    }

    public function __toString()
    {
        return $this->attributes[''];
    }
}
