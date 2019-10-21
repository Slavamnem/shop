<?php

namespace App\Objects;

use App\Enums\ReportPeriodTypesEnum;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CreateReportRequestObject
{
    /**
     * @var
     */
    private $fromDate;
    /**
     * @var
     */
    private $tillDate;
    /**
     * @var
     */
    private $reportType;
    /**
     * @var
     */
    private $periodType;

    /**
     * @param $value
     * @return $this
     */
    public function setFromDate($value)
    {
        $this->fromDate = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromDate()
    {
        return $this->fromDate ?? Carbon::yesterday()->toDateTimeString();
    }

    /**
     * @param $value
     * @return $this
     */
    public function setTillDate($value)
    {
        $this->tillDate = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTillDate()
    {
        return $this->tillDate ?? Carbon::now()->toDateTimeString();
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPeriodType($value)
    {
        $this->periodType = $value;
        return $this;
    }

    /**
     * @return ReportPeriodTypesEnum
     */
    public function getPeriodType()
    {
        return $this->periodType;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setReportType($value)
    {
        $this->reportType = $value;
        return $this;
    }

    /**
     * @return ReportPeriodTypesEnum
     */
    public function getReportType()
    {
        return $this->reportType;
    }
}
