<?php

namespace App\Services\Admin\Interfaces;

interface TableFilterDataInterface
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFilteredData();
}