<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 0:33
 */

namespace App\Objects;

use Illuminate\Support\Collection;

/**
 * Class GraphicDataObject
 * @package App\Objects
 */
class GraphicDataObject //TODO interface
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
     * GraphicDataObject constructor.
     */
    public function __construct()
    {
        $this->items = collect();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return GraphicDataObject
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setItem($key, $value)
    {
        $this->items->put($key, $value);
        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    public function incrementItem($key, $value)
    {
        $this->items->put($key, $this->items->get($key) + $value);
    }

    /**
     * @param $labels
     * @return $this
     */
    public function createSkeleton($labels)
    {
        foreach ($labels as $label) {
            $this->items->put($label, 0);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return $this->items->keys()->all();
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->items->values()->all();
    }
}
