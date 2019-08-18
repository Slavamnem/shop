<?php

namespace App\Services\Admin\Interfaces;

use App\Share;

interface ShareServiceInterface
{
    /**
     * @param Share $share
     * @return mixed
     */
    public function setConditions(Share $share);

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredShares();
}