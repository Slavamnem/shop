<?php

namespace App\Http\Controllers\Site;

use App\Product;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCardController extends Controller
{
    /**
     * @var ProductServiceInterface
     */
    private $productService;

    /**
     * ProductCardController constructor.
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @param $slug
     * @return string
     */
    public function index(Request $request, $slug)
    {
        $data = $this->productService->getData($request->input('id'));

        return view("site.product.card", $data);
    }
}
