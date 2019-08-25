<?php

namespace App\Services\Admin;

use App\ModelGroup;
use Illuminate\Http\Request;

class ModelGroupService
{
    /**
     * @var Request
     */
    private $request;
    /**
     * ProductServiceInterface constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredGroups()
    {
        $groups = ModelGroup::query()
            ->where(
                $this->request->input("field"),
                "like",
                "%" . $this->request->input("value") . "%")
            ->paginate(10);

        return $groups;
    }
}
