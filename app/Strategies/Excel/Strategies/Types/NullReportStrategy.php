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
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Carbon\Carbon;

class NullReportStrategy extends AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        //
    }

    /**
     * @return string
     */
    public function getReportName()
    {
        return 'null_report';
    }
}
