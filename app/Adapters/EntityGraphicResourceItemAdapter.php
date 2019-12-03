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
     * @var
     */
    private $value;

    /**
     * EntityGraphicResourceItemAdapter constructor.
     * @param Model $entity
     * @param null $itemQualifierClosure
     * @param int $itemValueClosure
     */
    public function __construct(Model $entity, $itemQualifierClosure = null, $itemValueClosure = 1)
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
        $this->label = is_callable($itemQualifierClosure) ? $itemQualifierClosure($this->entity) : null;
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
    public function setValue($itemValueClosure = 1) : GraphicResourceItem
    {
        $this->value = is_callable($itemValueClosure) ? $itemValueClosure($this->entity) : $itemValueClosure;
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
