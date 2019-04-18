<?php

namespace App\Services\Admin\Interfaces;

use App\Share;

interface ShareServiceInterface
{
    /**
     * @param Share $share
     * @return mixed
     */
    public function saveConditions(Share $share);
}