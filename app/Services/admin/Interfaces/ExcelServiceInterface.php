<?php

namespace App\Services\Admin\Interfaces;

use App\Objects\CreateReportRequestObject;

interface ExcelServiceInterface
{
    /**
     * @param CreateReportRequestObject $requestObject
     * @return \App\Components\Documents\Document
     */
    public function getReport(CreateReportRequestObject $requestObject);

//    /**
//     * @return array
//     */
//    public function getAvailableExportsList();
//
//    /**
//     * @param CreateReportRequestObject $requestObject
//     * @return \App\Components\Documents\Document
//     */
//    public function getAllOrdersReportDocument(CreateReportRequestObject $requestObject);
//
//    /**
//     * @param CreateReportRequestObject $requestObject
//     * @return \App\Components\Documents\Document
//     */
//    public function getOrdersStatsReportDocument(CreateReportRequestObject $requestObject);
}
