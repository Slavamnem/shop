<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Services\Admin\Interfaces\SiteElementsServiceInterface;
use App\SiteElement;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteElementsService implements SiteElementsServiceInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * CategoryService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredElements()
    {
        $siteElements = SiteElement::query()
            ->where(
                $this->request->input("field"),
                "like",
                "%" . $this->request->input("value") . "%"
            )
            ->paginate(10);

        return $siteElements;
    }
}
