<?php

namespace App\Builders;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Components\Documents\Document;
use App\Components\Documents\TxtDocument;

class DocumentBuilder implements DocumentBuilderInterface
{
    /**
     * @var Document
     */
    protected $document;

    /**
     * @return Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param $docName
     */
    public function createDocument($docName)
    {
        $this->document = new TxtDocument($docName);
    }

    public function rename($docName)
    {
        $this->document->setName($docName);
    }

    /**
     * @param $value
     * @param null $name
     */
    public function addRow($value, $name = null)
    {
        $this->document->addRow($value);
    }

    public function saveDocument()
    {
        $this->document->render();
        $this->document->save();
    }
}
