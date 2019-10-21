<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:11
 */

namespace App\Strategies\Excel;

use App\Enums\ReportPeriodTypesEnum;
use App\Strategies\Excel\Strategies\PeriodType\ExcelDayReportPeriodStrategy;
use App\Strategies\Excel\Strategies\PeriodType\ExcelMonthReportPeriodStrategy;
use App\Strategies\Excel\Strategies\PeriodType\ExcelNullReportTypePeriodStrategy;
use App\Strategies\Excel\Strategies\PeriodType\ExcelYearReportPeriodStrategy;
use App\Strategies\Interfaces\ExcelReportPeriodStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class ExcelReportPeriodTypeStrategy implements StrategyInterface
{
    /**
     * @var Collection
     */
    private $strategies;

    public function __construct()
    {
        $this->loadStrategies();
    }

    public function loadStrategies()
    {
        $this->strategies = collect();
        $this->strategies->put(ReportPeriodTypesEnum::YEAR()->getValue(), new ExcelYearReportPeriodStrategy());
        $this->strategies->put(ReportPeriodTypesEnum::MONTH()->getValue(), new ExcelMonthReportPeriodStrategy());
        $this->strategies->put(ReportPeriodTypesEnum::DAY()->getValue(), new ExcelDayReportPeriodStrategy());
    }

    /**
     * @param $type
     * @return ExcelReportPeriodStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new ExcelNullReportTypePeriodStrategy();
        }

        return $this->strategies->get($type);
    }
}
