<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $table = "delivery_types";

    protected $fillable = ['name'];
}
