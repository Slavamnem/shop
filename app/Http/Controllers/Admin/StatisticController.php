<?php

namespace App\Http\Controllers\Admin;

use App\Builders\ExcelDocumentBuilder;
use App\Category;
use App\Client;
use App\DeliveryType;
use App\Enums\PaymentTypesEnum;
use App\Exports\OrdersExport;
use App\Http\Middleware\SectionsAccess\StatsAccessMiddleware;
use App\Http\Requests\Admin\EditOrderRequest;
use App\Http\Resources\OrderResource;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\ExcelService;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StatisticController extends Controller
{
    const MENU_ITEM_NAME = "stats";

    /**
     * @var Request
     */
    private $request;
    /**
     * @var StatisticServiceInterface
     */
    private $service;

    /**
     * StatisticController constructor.
     * @param Request $request
     * @param StatisticServiceInterface $service
     */
    public function __construct(Request $request, StatisticServiceInterface $service)
    {
        $this->request = $request;
        $this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->middleware([StatsAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.stats.index");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopProducts()
    {
        $products = $this->service->getProductsList();

        return view("admin.stats.top_products", compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductsList()
    {
        $products = $this->service->getProductsList();

        return view("admin.stats.products_list", compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopClients()
    {
        $clients = Client::query()->with('orders')->get();

        return view("admin.stats.top_clients", compact('clients'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersStats()
    {
        return response()->json($this->service->getOrdersStats());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersStatsMonth()
    {
        return response()->json($this->service->getOrdersStatsMonth());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersPaymentTypesStats()
    {
        return response()->json($this->service->getOrdersPaymentTypesStats());
    }

    public function export()
    {
        return response()->download((new ExcelService())->getAllOrdersReportDocument()->getPath());


        dump((new ExcelService())->getAllOrdersReport());
        dd(1);
        $builder = new ExcelDocumentBuilder;

        $builder->createDocument('orders');

        $builder->addRow(['1', '2', '3', '4', '5'], 1);

        foreach (Order::all() as $key => $order) {
            $builder->addRow((new OrderResource($order))->toArray(request()), $key + 2);
        }

        $builder->saveDocument();

        return response()->download($builder->getDocument()->getPath());

        /*
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->setCellValue("A1", 'Город');
        $sheet->setCellValue("B1", 'Сумма');
        $sheet->setCellValue("C1", 'Отделение');

        foreach (Order::all() as $key => $order) {
            $sheet->setCellValue("A" . ($key + 2), $order->city);
            $sheet->setCellValue("B" . ($key + 2), $order->sum);
            $sheet->setCellValue("C" . ($key + 2), $order->warehouse);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('test4.xlsx');

        return response()->download('./test4.xlsx');

        //return Excel::download(new OrdersExport(), 'invoices.xlsx');
        */
    }
}
