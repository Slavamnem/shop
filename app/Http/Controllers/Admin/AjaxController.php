<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Services\TranslatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /**
     * @var
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getTranslation()
    {
        return TranslatorService::translate($this->request->get('value'));
    }

    public function getFilteredData()
    {
        $tablesModelClasses = [
            "products" => Product::class
        ];

        $modelClass = $tablesModelClasses[$this->request->input("table")];
        $products = $modelClass::query()
            ->with(['color', 'size', 'category'])
            ->where($this->request->input("field"),"like", "%" . $this->request->input("value") . "%")
            ->paginate(10);

        return view("admin.products.filtered_table", compact('products'));
    }
}
