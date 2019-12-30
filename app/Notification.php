<?php

namespace App;

use App\Components\Graphics\Interfaces\GraphicResourceItem;
use App\Traits\GraphicResourceItemTrait;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model implements GraphicResourceItem
{
    use GraphicResourceItemTrait;

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
