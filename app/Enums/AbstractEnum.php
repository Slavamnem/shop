<?php

namespace App\Enums;

use App\Components\Enum;

abstract class AbstractEnum extends Enum
{
    /**
     * @var
     */
    protected $value;
    /**
     * @var
     */
    protected $enums;

    /**
     * AbstractEnum constructor.
     * @param null $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getEnums()
    {
        return $this->enums;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getValueById($id)
    {
        return array_get($this->enums, $id, null);
    }
}