<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "description",
        "fix_price",
        "discount",
        "priority",
        "conditions",
        "active_from",
        "active_to",
        "image",
        "small_image"
    ];

    protected $casts = [
        "conditions" => "array"
    ];

    /**
     * @param $conditions
     * @return $this
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
        return $this;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active_from', '<=', Carbon::now())->where('active_to', '>=', Carbon::now());
    }
}
