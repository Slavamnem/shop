<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies\Types;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Objects\CreateReportRequestObject;
use App\Strategies\Excel\ExcelReportPeriodTypeStrategy;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;

abstract class AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @var DocumentBuilderInterface
     */
    protected $builder;
    /**
     * @var CreateReportRequestObject
     */
    protected $requestObject;
    /**
     * @var ExcelReportPeriodTypeStrategy
     */
    protected $reportPeriodTypeStrategy;

    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    abstract function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject);

    /**
     * @return string
     */
    abstract function getReportName();

    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     */
    protected function initialize(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        $this->builder = $builder;
        $this->requestObject = $requestObject;
        $this->reportPeriodTypeStrategy = new ExcelReportPeriodTypeStrategy();
    }
}
