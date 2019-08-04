<?php

namespace App\Builders;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Components\Documents\XmlDocument;

class XmlDocumentBuilder extends DocumentBuilder implements DocumentBuilderInterface
{
    /**
     * @param $docName
     */
    public function createDocument($docName)
    {
        $this->document = new XmlDocument($docName);
    }

    /**
     * @param $value
     * @param null $name
     */
    public function addRow($value, $name = null)
    {
        (gettype($value) == "array") ? $this->document->addNestedItem($name, $value) : $this->document->addItem($name, $value);
    }
}