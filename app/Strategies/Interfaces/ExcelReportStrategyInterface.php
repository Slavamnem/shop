<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.09.2019
 * Time: 0:33
 */

namespace App\Strategies\Interfaces;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Objects\CreateReportRequestObject;

interface ExcelReportStrategyInterface
{
    /**
     * @return string
     */
    public function getReportName();

    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject);
}
