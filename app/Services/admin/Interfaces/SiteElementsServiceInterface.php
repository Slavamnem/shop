<?php

namespace App\Services\Admin\Interfaces;

interface SiteElementsServiceInterface
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredElements();
}
