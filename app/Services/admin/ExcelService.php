<?php

namespace App\Services\Admin;

use App\Builders\ExcelDocumentBuilder;
use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Objects\CreateReportRequestObject;
use App\Services\Admin\Interfaces\ExcelServiceInterface;
use App\Strategies\Excel\ExcelReportPeriodTypeStrategy;
use App\Strategies\Excel\ExcelReportTypeStrategy;

class ExcelService implements ExcelServiceInterface
{
    /**
     * @var DocumentBuilderInterface
     */
    private $builder;
    /**
     * @var ExcelReportTypeStrategy
     */
    private $reportTypeStrategy;
    /**
     * @var ExcelReportPeriodTypeStrategy
     */
    private $reportPeriodTypeStrategy;

    /**
     * ExcelService constructor.
     */
    public function __construct()
    {
        $this->builder = new ExcelDocumentBuilder();
        $this->reportTypeStrategy = new ExcelReportTypeStrategy();
        $this->reportPeriodTypeStrategy = new ExcelReportPeriodTypeStrategy();
    }

    /**
     * @param CreateReportRequestObject $requestObject
     * @return \App\Components\Documents\Document
     */
    public function getReport(CreateReportRequestObject $requestObject)
    {
        $this->builder->createDocument($this->reportTypeStrategy->getStrategy(
            $requestObject->getReportType()->getValue()
        )->getReportName());

        $this->reportTypeStrategy->getStrategy(
            $requestObject->getReportType()->getValue()
        )->setReportData($this->builder, $requestObject);

        $this->builder->saveDocument();

        return $this->builder->getDocument();
    }
}
