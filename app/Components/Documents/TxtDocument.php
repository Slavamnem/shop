<?php

namespace App\Components\Documents;

use App\Components\Documents\Document;
use App\Components\Interfaces\DocumentInterface;
use App\Components\Interfaces\SaveDataToFileInterface;
use App\Components\Interfaces\XmlDocumentInterface;
use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;

class TxtDocument extends Document implements DocumentInterface
{
    /**
     * @return mixed
     */
    public function render()
    {
        $content = implode(PHP_EOL, (array)$this->rows);

        $this->setContent($content);
    }
}
