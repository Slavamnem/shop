<?php

namespace App\Builders;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Components\Documents\ExcelDocument;
use App\Components\Documents\XmlDocument;
use Maatwebsite\Excel\Excel;

class ExcelDocumentBuilder extends DocumentBuilder implements DocumentBuilderInterface
{
    /**
     * @param $docName
     */
    public function createDocument($docName)
    {
        $this->document = new ExcelDocument(rtrim($docName, '.xlsx') . '.xlsx');
    }

    /**
     * @param $value
     * @param $rowNum
     */
    public function addRow($value, $rowNum = null)
    {
        (gettype($value) == "array") ? $this->document->addNestedItem($rowNum, array_values($value)) : $this->document->addItem($rowNum, $value);
    }
}
