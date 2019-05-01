<?php

namespace App\Components\Interfaces;

interface XmlDocumentInterface
{
    /**
     * @return mixed
     */
    public function render();

    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @param $name
     * @param $value
     */
    public function addItem($name, $value);

    /**
     * @param $name
     * @param $data
     */
    public function addNestedItem($name, $data);
}