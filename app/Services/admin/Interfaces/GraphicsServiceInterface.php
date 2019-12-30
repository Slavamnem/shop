<?php

namespace App\Services\Admin\Interfaces;

use App\Components\Graphics\Interfaces\Graphic;

interface GraphicsServiceInterface
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
}
