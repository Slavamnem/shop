<?php

namespace App\Components;

use App\Components\Interfaces\SaveDataToFileInterface;
use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;

class Xml implements SaveDataToFileInterface
{
    /**
     * @param $data
     * @param $fileName
     * @param $nestedItemName
     * @return mixed|string
     */
    public function saveToFile($data, $fileName, $nestedItemName = null)
    {
        //$res = ArrayToXml::convert($data);

        $xmlDoc = new XmlDocument();
        foreach ($data as $key => $item) {
            $nestedItemName ? $xmlDoc->addNestedItem($nestedItemName, $item) : $xmlDoc->addItem($key, $item);
        }

        Storage::put($fileName, $xmlDoc);

        return storage_path("app/{$fileName}");
    }
}