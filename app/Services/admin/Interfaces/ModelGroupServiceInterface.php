<?php

namespace App\Services\Admin\Interfaces;

use Illuminate\Http\Request;

interface ModelGroupServiceInterface
{
    /**
     * ProductServiceInterface constructor.
     * @param Request $request
     */
    public function __construct(Request $request);

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredGroups();
}
