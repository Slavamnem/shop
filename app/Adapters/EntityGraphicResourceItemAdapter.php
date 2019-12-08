<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:13
 */

namespace App\Adapters;

use App\Components\Graphics\GraphicResourceItem;
use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EntityGraphicResourceItemAdapter implements GraphicResourceItem
{
    /**
     * @var Model
     */
    private $entity;
    /**
     * @var string
     */
    private $label;
    /**
     * @var mixed
     */
    private $value;

    /**
     * EntityGraphicResourceItemAdapter constructor.
     * @param Model $entity
     * @param null $itemQualifierClosure
     * @param int $itemValueClosure
     */
    public function __construct(Model $entity, $itemQualifierClosure = null, $itemValueClosure = null)
    {
        $this->entity = $entity;
        $this->setLabel($itemQualifierClosure);
        $this->setValue($itemValueClosure);
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @param null $itemQualifierClosure
     * @return GraphicResourceItem
     */
    public function setLabel($itemQualifierClosure = null) : GraphicResourceItem
    {
        $this->label = is_callable($itemQualifierClosure) ? $itemQualifierClosure($this->entity) : '-';
        return $this;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @param int $itemValueClosure
     * @return GraphicResourceItem
     */
    public function setValue($itemValueClosure = null) : GraphicResourceItem
    {
        $this->value = is_callable($itemValueClosure) ? $itemValueClosure($this->entity) : 1;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreationDate() : Carbon
    {
        return $this->entity->created_at;
    }
}
