<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "description",
        "fix_price",
        "discount",
        "conditions",
        "active_from",
        "active_to",
        "image",
        "small_image"
    ];

    protected $casts = [
        "conditions" => "array"
    ];
}
