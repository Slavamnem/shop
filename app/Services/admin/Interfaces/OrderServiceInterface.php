<?php

namespace App\Services\Admin\Interfaces;

interface OrderServiceInterface
{
    /**
     * Return data for views
     *
     * @param $id
     * @return array
     */
    public function getData($id = null);
}