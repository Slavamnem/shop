<?php

namespace App\Components\Interfaces;

interface XmlDocumentInterface extends DocumentInterface
{
    /**
     * @param $name
     * @param $value
     */
    public function addItem($name, $value);

    /**
     * @param $name
     * @param $value
     */
    public function addNestedItem($name, $value);
}