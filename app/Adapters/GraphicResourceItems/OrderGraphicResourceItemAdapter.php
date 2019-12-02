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
     * @var string
     */
    private $type;

    /**
     * OrderGraphicResourceItemAdapter constructor.
     * @param Order $order
     * @param null $type
     */
    public function __construct(Order $order, $type = null)
    {
        $this->order = $order;
        $this->type = $type;
    }

    /**
     * @return array|int
     */
    public function getYearLabel()
    {
        return lang("months." . $this->order->created_at->format('F'));
    }

    /**
     * @return array|int
     */
    public function getMonthLabel()
    {
        return $this->order->created_at->day - 1;
    }

    /**
     * @return int
     */
    public function getDayLabel()
    {
        return $this->order->created_at->hour;
    }

    /**
     * @return null|string
     */
    public function getVariationLabel()
    {
        return $this->type;
    }

    /**
     * @return array|float
     */
    public function getValue()
    {
        return $this->order->sum;
    }
}
