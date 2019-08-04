<?php

namespace App\Builders\Interfaces;

use App\Components\Documents\Document;

interface DocumentBuilderInterface
{
    /**
     * @return Document
     */
    public function getDocument();

    /**
     * @param $value
     * @param null $name
     */
    public function addRow($value, $name = null);

    /**
     * @param $docName
     */
    public function createDocument($docName);

    public function saveDocument();
}