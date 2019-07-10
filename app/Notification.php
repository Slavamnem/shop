<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";

    protected $fillable = [
        'preview',
        'message',
        'status',
        'priority_id'
    ];

    public function priority()
    {
        return $this->hasOne(Priority::class, 'id', 'priority_id');
    }
}
