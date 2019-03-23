<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $table = "orders";

    public function delivery()
    {
        return $this->hasOne(DeliveryType::class, "id", "delivery_type_id");
    }
}
