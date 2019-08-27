<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Components\RestApi\NovaPoshta;
use App\Components\Xml;
use App\Enums\ProductStatusEnum;
use App\Events\NewOrderEvent;
use App\Http\Middleware\SectionsAccess\ClientsAccessMiddleware;
use App\Http\Requests\Admin\CreateClientRequest;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use App\Property;
use App\Services\Admin\Interfaces\ClientServiceInterface;
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

class ClientController extends Controller
{
    const MENU_ITEM_NAME = "clients";

    /**
     * @var
     */
    private $request;
    /**
     * @var ClientServiceInterface
     */
    private $service;

    /**
     * ProductController constructor.
     * @param Request $request
     * @param ClientServiceInterface $service
     */
    public function __construct(Request $request, ClientServiceInterface $service)
    {
        $this->request = $request;
        $this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->middleware([ClientsAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::query()->paginate(10);

        return view("admin.clients.index", compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.clients.create");
    }

    /**
     * @param CreateClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CreateClientRequest $request)
    {
        $client = new Client();

        $client->fill($request->only($client->getFillable()));
        $client->save();

        return redirect()->route("admin-clients-edit", ['id' => $client->id]);
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

        return view("admin.clients.show", $data);
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

        return view("admin.clients.edit", $data);
    }

    /**
     * @param UpdateClientRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::find($id);

        $client->fill($request->only($client->getFillable()));

        $client->save();

        return redirect()->route("admin-clients-edit", ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect()->route("admin-clients");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $clients = $this->service->getFilteredClients();

        return view("admin.clients.filtered_table", compact('clients'));
    }
}
