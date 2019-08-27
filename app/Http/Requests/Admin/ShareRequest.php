<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShareRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function hasConditions()
    {
        return !empty($this->input('conditions'));
    }

    /**
     * @return mixed
     */
    public function getConditions()
    {
        return $this->input('conditions');
    }

    /**
     * @param $num
     * @return mixed
     */
    public function getCondition($num)
    {
        return @array_get($this->input('conditions'), $num);
    }

    /**
     * @param $num
     * @return bool
     */
    public function isRealCondition($num)
    {
        return (!empty($this->getCondition($num)) and !empty($this->getConditionValue($num)));
    }

    /**
     * @return mixed
     */
    public function getConditionsValues()
    {
        return $this->input('conditions_values');
    }

    /**
     * @param $num
     * @return mixed
     */
    public function getConditionValue($num)
    {
        return @array_get($this->input('conditions_values'), $num);
    }

    /**
     * @return mixed
     */
    public function getConditionsDelimiter()
    {
        return $this->input('conditions_delimiter');
    }

    /**
     * @param $num
     * @return mixed
     */
    public function getConditionOperation($num)
    {
        return array_get($this->input('operations'), $num);
    }
}
