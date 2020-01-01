<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.2019
 * Time: 14:56
 */

namespace App\Objects;

class TimePeriodObject
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
     * @return mixed
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * @param mixed $fromDate
     * @return TimePeriodObject
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTillDate()
    {
        return $this->tillDate;
    }

    /**
     * @param mixed $tillDate
     * @return TimePeriodObject
     */
    public function setTillDate($tillDate)
    {
        $this->tillDate = $tillDate;
        return $this;
    }
}
