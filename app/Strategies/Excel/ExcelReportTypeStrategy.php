<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:11
 */

namespace App\Strategies\Excel;

use App\Enums\ReportTypesEnum;
use App\Strategies\Excel\Strategies\ExcelDayReportStrategy;
use App\Strategies\Excel\Strategies\ExcelMonthReportStrategy;
use App\Strategies\Excel\Strategies\ExcelNullReportTypeStrategy;
use App\Strategies\Excel\Strategies\ExcelYearReportStrategy;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class ExcelReportTypeStrategy implements StrategyInterface
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
        $this->strategies->put(ReportTypesEnum::YEAR()->getValue(), new ExcelYearReportStrategy());
        $this->strategies->put(ReportTypesEnum::MONTH()->getValue(), new ExcelMonthReportStrategy());
        $this->strategies->put(ReportTypesEnum::DAY()->getValue(), new ExcelDayReportStrategy());
    }

    /**
     * @param $type
     * @return ExcelReportStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new ExcelNullReportTypeStrategy();
        }

        return $this->strategies->get($type);
    }
}
