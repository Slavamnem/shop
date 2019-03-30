<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewOrderEvent;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use App\Services\Admin\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    const MENU_ITEM_NAME = "products";

    /**
     * @var ProductService
     */
    private $service;

    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['color', 'size', 'category'])->paginate(10);

        return view("admin.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->service->getData();

        return view("admin.products.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->fill($request->only($product->getFillable()));
        $this->service->saveImages($product);
        $product->save();

        return redirect()->route("admin-products-edit", ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->service->getData($id);

        return view("admin.products.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->service->getData($id);

        return view("admin.products.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->fill($request->only($product->getFillable()));
        $this->service->saveImages($product);

        $product->save();

        return redirect()->route("admin-products-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route("admin-products");
    }

}
