<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:45
 */

namespace App\Objects;

class ProfitPeriodItemObject
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var
     */
    private $profit;
    /**
     * @var
     */
    private $total;

    public function __construct()
    {
        $this->profit = 0;
        $this->total = 0;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAverage()
    {
        return $this->total ? $this->profit / $this->total : 0;
    }

    /**
     * @param $value
     * @return $this
     */
    public function addProfit($value)
    {
        $this->profit += $value;
        $this->total++;
        return $this;
    }

    /**
     * @return double
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}