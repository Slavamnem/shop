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
}
