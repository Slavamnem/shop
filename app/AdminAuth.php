<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminAuth extends Model
{
    protected $table = "admin_auth";

    protected $fillable = [
        'user_id',
        'trace',
        'ip_address',
    ];

    protected $casts = [
        'trace' => 'array'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
