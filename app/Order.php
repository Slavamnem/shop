<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $table = "orders";

    protected $fillable = [
        "status_id",
        "sum",
        "user_id",
        "client_id",
        "description",
        "phone",
        "email",
        "payment_type_id",
        "delivery_type_id"
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
}
