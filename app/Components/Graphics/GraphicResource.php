<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:00
 */

namespace App\Components\Graphics;

interface GraphicResource
{
    /**
     * @return array
     */
    public function getLabels();

    /**
     * @return array
     */
    public function getValues();
}
