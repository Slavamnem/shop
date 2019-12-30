<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:12
 */

namespace App\Components\Graphics;

use App\Components\Graphics\Interfaces\Graphic;

class SingleGraphicDiagram extends AbstractGraphic implements Graphic
{
    /**
     * @return array
     */
    public function getGraphicData()
    {
        return [
            'title'  => $this->getTitle(),
            'labels' => $this->graphicResources->first()->getLabels(),
            'values' => $this->graphicResources->first()->getValues(),
        ];
    }
}
