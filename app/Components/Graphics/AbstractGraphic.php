<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:11
 */

namespace App\Components\Graphics;

use Illuminate\Support\Collection;

abstract class AbstractGraphic implements Graphic
{
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $segregationType;
    /**
     * @var Collection
     */
    protected $graphicResources;

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
     * @return string
     */
    public function getSegregationType(): string
    {
        return $this->segregationType;
    }

    /**
     * @param string $segregationType
     * @return Graphic
     */
    public function setSegregationType(string $segregationType): Graphic
    {
        dump(2);
        $this->segregationType = $segregationType;
        return $this;
    }

    /**
     * @param GraphicResource $graphicResource
     * @return Graphic
     */
    public function addResource(GraphicResource $graphicResource)
    {
        dd('addResource');
        $this->graphicResources->push($graphicResource->setSegregationType($this->getSegregationType()));
        return $this;
    }

    /**
     * @return array
     */
    abstract public function getGraphicData();
}
