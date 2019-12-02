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
    private $label;

    /**
     * OrderGraphicResourceItemAdapter constructor.
     * @param Order $order
     * @param null $itemQualifierClosure
     */
    public function __construct(Order $order, $itemQualifierClosure = null)
    {
        $this->order = $order;
        $this->label = $itemQualifierClosure ? $this->determineLabel($itemQualifierClosure) : null;
    }

    /**
     * @param $itemQualifierClosure
     * @return mixed
     */
    public function determineLabel($itemQualifierClosure)
    {
        return $itemQualifierClosure($this->order);
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getCreationDate() //TODO вынести в абстрактный класс адаптеров
    {
        return $this->order->created_at;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return array|float
     */
    public function getValue() //TODO причина необходимости адаптера и моста между ресурсами и айтемами
    {
        return $this->order->sum;
    }
}
