<?php

namespace App\Objects;

use App\Enums\ReportTypesEnum;
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
    private $type;

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
        return $this->fromDate ?? Carbon::now()->toDateTimeString();
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
    public function setType($value)
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @return ReportTypesEnum
     */
    public function getType()
    {
        return $this->type;
    }
}
