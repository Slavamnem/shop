<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportPeriodTypesEnum;
use App\Enums\ReportTypesEnum;
use App\Objects\CreateReportRequestObject;
use App\Services\Admin\Interfaces\ExcelServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * @var ExcelServiceInterface
     */
    private $excelService;

    /**
     * ReportController constructor.
     * @param ExcelServiceInterface $excelService
     */
    public function __construct(ExcelServiceInterface $excelService)
    {
        $this->excelService = $excelService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.reports.index', ['reports' => (new ReportTypesEnum())->getEnums()]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        return response()->download($this->excelService
            ->getReport((new CreateReportRequestObject())
                ->setReportType(ReportTypesEnum::CREATE($request->input('report_type')))
                ->setPeriodType(ReportPeriodTypesEnum::CREATE($request->input('period_type')))
                ->setFromDate($request->input('from_date'))
                ->setTillDate($request->input('till_date'))
            )
            ->getPath()
        );
    }
}
