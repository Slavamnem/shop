<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:00
 */

namespace App\Components\Graphics;

interface GraphicResourceItem
{
    /**
     * @param $itemQualifierClosure
     * @return mixed
     */
    public function determineLabel($itemQualifierClosure);

    /**
     * @return \Carbon\Carbon
     */
    public function getCreationDate(); //TODO вынести в абстрактный класс адаптеров

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return array|float
     */
    public function getValue();
}
