<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Components\RestApi\NovaPoshta;
use App\Components\Xml;
use App\Events\NewOrderEvent;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Product;
use App\Property;
use App\Repositories\ProductsRepository;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    const MENU_ITEM_NAME = "products";

    /**
     * @var ProductService
     */
    private $service;
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * ProductController constructor.
     * @param ProductServiceInterface $service
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductServiceInterface $service, ProductsRepository $productsRepository)
    {
        dump("module admin");
        $this->service = $service;
        $this->productsRepository = $productsRepository;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $novaPoshta = new NovaPoshta();
//
//        dd($novaPoshta->getCities([
//            "Language" => "ru",
//            "Page" => 1,
//            "Warehouse" => true
//        ])->data);
//
//        dd($novaPoshta->getWarehouses([
//            "CityName" => "Черкаси",
//            "Language" => "ru"
//        ])->data);

        return view("admin.products.index", ['products' => $this->productsRepository->getLastProducts()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->service->getData();

        return view("admin::views.products.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product();

        $product->fill($request->only($product->getFillable()));
        $this->service->saveImages($product, $request);
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
     * @param  UpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
//        dump($request->all());
        $product = $this->productsRepository->getProductById($id);

        $product->fill($request->only($product->getFillable()));
        $this->service->saveImages($product, $request);
        $this->service->saveProperties($product, $request);

        $product->save();

        return redirect()->route("admin-products-edit", ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->productsRepository->getProductById($id)->delete();

        return redirect()->route("admin-products"); 
    }

    /**
     * @return mixed
     */
    public function saveAsXml()
    {
        $data = $this->productsRepository->getAllProducts();

        return $this->service->saveToFile(new Xml(), $data->toArray());
    }

    public function addNewProperty()
    {
        $properties = Property::all();
        return view("admin.properties.new-property", compact('properties'))->render();
    }

    public function addNewImage()
    {
        Session::put("newImageId", Session::get("newImageId") +1 ?? 1);
        $imageId = Session::get("newImageId");

        return view("admin.images.new-image", compact('imageId'))->render();
    }

    public function addNewCondition()
    {

    }
}
