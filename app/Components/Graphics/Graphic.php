<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:03
 */

namespace App\Components\Graphics;

interface Graphic
{
    /**
     * @return string
     * @return Graphic
     */
    public function getTitle();

    /**
     * @param string $title
     * @return Graphic
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getSegregationType(): string;

    /**
     * @param string $segregationType
     * @return Graphic
     */
    public function setSegregationType(string $segregationType): Graphic;

    /**
     * @param GraphicResource $graphicResource
     * @return Graphic;
     */
    public function addResource(GraphicResource $graphicResource);

    /**
     * @return array
     */
    public function getGraphicData();
}
