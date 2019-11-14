<?php

namespace App\Strategies\Conditions;

use App\PropertyValue;

class PropertyCondition extends AbstractCondition
{
    /**
     * @var
     */
    private $propertyId;

    public function __construct($type)
    {
        $this->propertyId = array_get(explode("-", $type), 1);
    }

    /**
     * @return $this|AbstractCondition
     */
    public function setValues()
    {
        $this->values = PropertyValue::query()
            ->where('property_id', $this->propertyId)
            ->get()
            ->mapWithKeys(function($propertyValue){
                return [$propertyValue->id => $propertyValue->value];
            });

        return $this;
    }
}
