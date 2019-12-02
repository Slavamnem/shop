<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:00
 */

namespace App\Components\Graphics;

use Illuminate\Support\Collection;

interface GraphicResource
{
    /**
     * @param Collection $resourceItems
     * @return GraphicResource
     */
    public function setResourceItems(Collection $resourceItems);

    /**
     * @return array
     */
    public function getLabels();

    /**
     * @return array
     */
    public function getValues();
}
