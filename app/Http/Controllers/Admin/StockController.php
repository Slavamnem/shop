<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Middleware\SectionsAccess\StockAccessMiddleware;
use App\Http\Requests\Admin\Stock\ChangeProductQuantityRequest;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class StockController extends Controller
{
    const MENU_ITEM_NAME = "stock";

    /**
     * @var Request
     */
    private $request;
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * StockController constructor.
     * @param Request $request
     * @param ProductsRepository $productsRepository
     */
    public function __construct(Request $request, ProductsRepository $productsRepository)
    {
        $this->request = $request;
        $this->productsRepository = $productsRepository;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->middleware([StockAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("admin.stock.index", compact('categories'));
    }

    /**
     * @param ChangeProductQuantityRequest $request
     */
    public function changeQuantity(ChangeProductQuantityRequest $request)
    {
        $this->productsRepository->updateProductQuantity($request);
    }
}
