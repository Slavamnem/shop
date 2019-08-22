<?php

namespace App\Http\Controllers\Admin;

use App\Builders\DocumentBuilder;
use App\Builders\TxtDocumentBuilder;
use App\Builders\XmlDocumentBuilder;
use App\Components\RestApi\NovaPoshta;
use App\Components\Xml;
use App\Enums\ProductStatusEnum;
use App\Events\NewOrderEvent;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use App\Property;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\ProductService;
use App\Services\ElasticSearchService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    const MENU_ITEM_NAME = "products";

    /**
     * @var
     */
    private $request;
    /**
     * @var ProductService
     */
    private $service;
    /**
     * @var
     */
    private $elasticService;

    /**
     * ProductController constructor.
     * @param Request $request
     * @param ProductServiceInterface $service
     * @param ElasticSearchService $elasticService
     */
    public function __construct(Request $request, ProductServiceInterface $service, ElasticSearchService $elasticService)
    {
        $this->request = $request;
        $this->service = $service;
        $this->elasticService = $elasticService;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = Product::all();
//        dump($data);
//        $this->service->saveToFile(new Xml(), $data);
        /*$novaPoshta = new NovaPoshta();

        dd($novaPoshta->getCities([
            "Language" => "ru",
            "Page" => 1,
            "Warehouse" => true
        ])->data);

        dd($novaPoshta->getWarehouses([
            "CityName" => "Черкаси",
            "Language" => "ru"
        ])->data);*/

        //dump($this->elasticService->searchByName("Футболка"));

        $products = Product::with(['color', 'size', 'category'])->orderByDesc('id')->paginate(10);

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
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product();

        $product->fill($request->only($product->getFillable()));
        $product->save();
        $this->service->saveImages($product);

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
     * @param EditProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(EditProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->only($product->getFillable()));
        $product->active = array_get($request->all(), "active", 0);
        $this->service->saveImages($product);
        $this->service->saveProperties($product);

        $product->save();
        //$this->elasticService->indexProduct($product);

        return redirect()->route("admin-products-edit", ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route("admin-products");
    }

    /**
     * @return mixed
     */
    public function saveAsXml()
    {
        $data = Product::all();

        return $this->service->saveToFile(new XmlDocumentBuilder(), $data->toArray(), "products-new.xml");
    }

    /**
     * @return mixed
     */
    public function saveAsTxt()
    {
        $data = Product::all();

        return $this->service->saveToFile(new TxtDocumentBuilder(), $data->toArray(), "products-new.txt");
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $products = $this->service->getFilteredProducts();

        return view("admin.products.filtered_table", compact('products'));
    }

    public function addNewCondition(){}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProducts()
    {
        $products = $this->elasticService->searchByName($this->request->input("name"));
//        $products = Product::query()
//            ->where("name", "LIKE", "%" . $this->request->input("name") . "%")
//            ->where("quantity", ">", 0)
//            ->where("status_id", ProductStatusEnum::AVAILABLE)
//            ->with(['color', 'size'])
//            ->paginate(10);

        return view("admin.products.new_order_products", compact("products", "products2"));
    }

    public function indexProducts()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $this->elasticService->indexProduct($product);
        }
    }
}
