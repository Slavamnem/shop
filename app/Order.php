<?php

namespace App;

use App\Enums\OrderStatusEnum;
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
        "warehouse"
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
}
