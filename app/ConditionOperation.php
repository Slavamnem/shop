<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConditionOperation extends Model
{
    protected $table = "conditions_operations";

    protected $fillable = ['name'];
}
