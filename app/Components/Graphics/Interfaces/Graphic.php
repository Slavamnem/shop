<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:03
 */

namespace App\Components\Graphics\Interfaces;

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
     * @param GraphicResource $graphicResource
     * @return Graphic;
     */
    public function addResource(GraphicResource $graphicResource);

    /**
     * @return array
     */
    public function getGraphicData();
}
