<?php

namespace App\Services\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    /**
     * @var
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
     * @param null $id
     * @return array
     */
    public static function getDataForCategoryPage($id = null)
    {
        $data = collect();
        $data->put("groups", ModelGroup::all());
        $data->put("statuses", ProductStatus::all());
        $data->put("colors", Color::all());
        $data->put("sizes", Size::all());
        if ($id) {
            $data->put("category", Category::find($id));
        }

        return $data->toArray();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredCategories()
    {
        $categories = Category::query()
            ->where(
                $this->request->input("field"),
                "like",
                "%" . $this->request->input("value") . "%"
            )
            ->paginate(10);

        return $categories;
    }
}
