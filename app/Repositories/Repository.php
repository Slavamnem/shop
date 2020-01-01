<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 0:45
 */

namespace App\Repositories;

use App\Http\Requests\Admin\Filter\EntityFilterRequest;

interface Repository
{
    /**
     * @param EntityFilterRequest $entityFilterRequest
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredItems(EntityFilterRequest $entityFilterRequest);
}
