<?php

namespace App\Components\Interfaces;

interface NovaPoshtaInterface
{
    /**
     * @param null $extraFields
     * @return mixed
     */
    public function getWarehouses($extraFields = null);

    /**
     * @param null $extraFields
     * @return mixed
     */
    public function getCities($extraFields = null);
}