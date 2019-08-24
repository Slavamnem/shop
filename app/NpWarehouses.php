<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpWarehouses extends Model
{
    protected $table = 'np_warehouses';

    protected $fillable = [
        'name',
        'ref',
        'address',
        'city_ref',
        'number',
        'phone'
    ];
}
