<?php

namespace App\Builders;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Components\Documents\TxtDocument;
use App\Components\Documents\XmlDocument;

class TxtDocumentBuilder extends DocumentBuilder implements DocumentBuilderInterface
{
    /**
     * @param $docName
     */
    public function createDocument($docName)
    {
        $this->document = new TxtDocument($docName);
    }

    /**
     * @param $value
     * @param null $name
     */
    public function addRow($value, $name = null)
    {
        if (gettype($value) == "array") {
            $data = collect();
            foreach ($value as $key => $item) {
                $data->push("{$key}: {$item}");
            }
            $this->document->addRow(implode(PHP_EOL, $data->toArray()));
        } else {
            $this->document->addRow($value);
        }
    }
}
