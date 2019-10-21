<?php

namespace App\Http\Controllers\Admin;

use App\Builders\ExcelDocumentBuilder;
use App\Category;
use App\Client;
use App\DeliveryType;
use App\Enums\PaymentTypesEnum;
use App\Enums\ReportPeriodTypesEnum;
use App\Exports\OrdersExport;
use App\Http\Middleware\SectionsAccess\StatsAccessMiddleware;
use App\Http\Requests\Admin\EditOrderRequest;
use App\Http\Resources\OrderResource;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Objects\CreateReportRequestObject;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use App\Product;
use App\Services\Admin\ExcelService;
use App\Services\Admin\Interfaces\StatisticServiceInterface;
use App\Services\Admin\OrderService;
use Carbon\Carbon;
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





    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportAllOrders()
    {
        return response()->download((new ExcelService())
            ->getAllOrdersReportDocument((new CreateReportRequestObject())
                ->setFromDate(Carbon::createFromTimestamp(strtotime('-1 month'))->toDateTimeString())
                ->setTillDate(Carbon::now()->toDateTimeString())
            )
            ->getPath()
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportYearOrders() //TODO maybe one function with period and type arguments
    {
        return response()->download((new ExcelService())
            ->getOrdersStatsReportDocument((new CreateReportRequestObject())
                ->setType(ReportPeriodTypesEnum::YEAR())
                ->setFromDate(Carbon::createFromTimestamp(strtotime('2019-01-01'))->toDateTimeString())
                ->setTillDate(Carbon::now()->toDateTimeString())
            )
            ->getPath()
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportMonthOrders()
    {
        return response()->download((new ExcelService())
            ->getOrdersStatsReportDocument((new CreateReportRequestObject())
                ->setType(ReportPeriodTypesEnum::MONTH())
                ->setFromDate(Carbon::createFromTimestamp(strtotime('2019-10-01'))->toDateTimeString())
                ->setTillDate(Carbon::now()->toDateTimeString())
            )
            ->getPath()
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportDayOrders()
    {
        return response()->download((new ExcelService())
            ->getOrdersStatsReportDocument((new CreateReportRequestObject())
                ->setType(ReportPeriodTypesEnum::DAY())
                ->setFromDate(Carbon::createFromTimestamp(strtotime('today'))->toDateTimeString())
                ->setTillDate(Carbon::now()->toDateTimeString())
            )
            ->getPath()
        );
    }
}
