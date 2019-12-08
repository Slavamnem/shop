<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:13
 */

namespace App\Components\Graphics;

class MultipleGraphicDiagram extends AbstractGraphic implements Graphic
{
    /**
     * @return array
     */
    public function getGraphicData()
    {
        return [
            'title'  => $this->getTitle(),
            'labels' => $this->graphicResources->first()->getLabels(),
            'values' => $this->graphicResources->map(function(GraphicResource $graphicResource){ return $graphicResource->getValues(); })->toArray(),
        ];
    }
}
