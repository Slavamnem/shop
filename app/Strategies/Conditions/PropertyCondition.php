<?php

namespace App\Strategies\Conditions;

use App\PropertyValue;

class PropertyCondition extends AbstractCondition
{
    /**
     * @param null $type
     * @return $this|mixed
     */
    public function getValues($type = null)
    {
        dump('prop');
        if (empty($this->values)) {
            if ($propertyId = array_get(explode("-", $type), 1)) {
                $this->values = PropertyValue::query()
                    ->where('property_id', $propertyId)
                    ->get()
                    ->mapWithKeys(function ($propertyValue) {
                        return [$propertyValue->id => $propertyValue->value];
                    });
            } else {
                $this->values = collect();
            }
        }

        return $this->values;
    }
}
