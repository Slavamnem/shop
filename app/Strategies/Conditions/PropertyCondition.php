<?php

namespace App\Strategies\Conditions;

use App\PropertyValue;

class PropertyCondition
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
     * @return array
     */
    public function getValues()
    {
        return PropertyValue::query()
            ->where('property_id', $this->propertyId)
            ->get()
            ->mapWithKeys(function($propertyValue){
                return [$propertyValue->id => $propertyValue->value];
            });
    }
}
