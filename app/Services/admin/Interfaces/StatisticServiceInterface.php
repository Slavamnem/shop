<?php

namespace App\Services\Admin\Interfaces;

use App\Components\Graphics\Graphic;

interface StatisticServiceInterface
{
    /**
     * @return Graphic
     */
    public function getOrdersStatsGraphic() : Graphic;

    /**
     * @return Graphic
     */
    public function getNotificationsStatsGraphic(): Graphic;

    /**
     * @return Graphic
     */
    public function getOrdersStatsMonthGraphic() : Graphic;

    /**
     * @return Graphic
     */
    public function getOrdersPaymentTypesStatsGraphic() : Graphic;

    /**
     * @return Graphic
     */
    public function getOrdersPaymentTypesStatsPieGraphic() : Graphic;

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProductsList();
}
