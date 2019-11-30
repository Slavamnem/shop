<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:13
 */

namespace App\Adapters\GraphicResourceItems;

use App\Components\Graphics\GraphicResourceItem;
use App\Order;

class OrderGraphicResourceItemAdapter implements GraphicResourceItem
{
    /**
     * @var Order
     */
    private $order;

    /**
     * OrderGraphicResourceItemAdapter constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return array|int
     */
    public function getLabel()
    {
        return lang("months." . $this->order->created_at->format('F'));
    }

    /**
     * @return array|float
     */
    public function getValue()
    {
        return $this->order->sum;
    }
}
