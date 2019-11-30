<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 17:12
 */

namespace App\Components\Graphics;

use Illuminate\Support\Collection;

class SingleGraphicDiagram implements Graphic
{
    /**
     * @var
     */
    private $title;
    /**
     * @var Collection
     */
    private $items;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Graphic
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}
