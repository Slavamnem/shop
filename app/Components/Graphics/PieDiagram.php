<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:24
 */

namespace App\Components\Graphics;

class PieDiagram extends AbstractGraphic implements Graphic
{
    /**
     * @return array
     */
    public function getGraphicData()
    {
        return [
            'title'   => $this->getTitle(),
            'columns' => $this->graphicResources
                ->first()
                ->getResourceGrid()
                ->mapWithKeys(function($value, $key){ return [$key => [$key, $value]]; })
                ->values()
                ->all(),
        ];
    }
}