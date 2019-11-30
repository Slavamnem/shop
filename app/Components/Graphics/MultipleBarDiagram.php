<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:11
 */

namespace App\Components\Graphics;

use Illuminate\Support\Collection;

class MultipleBarDiagram implements Graphic
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var Collection
     */
    private $items;
    /**
     * @var Collection
     */
    private $graphicResources;

    /**
     * MultipleBarDiagram constructor.
     */
    public function __construct()
    {
        $this->graphicResources = collect();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Graphic
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param GraphicResource $graphicResource
     * @return Graphic
     */
    public function addResource(GraphicResource $graphicResource)
    {
        $this->graphicResources->push($graphicResource);
        return $this;
    }

    /**
     * @return array
     */
    public function getGraphicData()
    {
        return [
            'title'  => $this->getTitle(),
            'labels' => array_values($this->graphicResources->first()->getLabels()),
            'values' => $this->graphicResources->map(function(GraphicResource $graphicResource){ return $graphicResource->getValues(); })->toArray(),
        ];
    }
}
