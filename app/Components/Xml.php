<?php

namespace App\Components;

use App\Components\Interfaces\SaveDataToFileInterface;
use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;

class Xml implements SaveDataToFileInterface
{
    /**
     * @param array $data
     * @param string $fileName
     * @return string
     */
    public function saveToFile(array $data, $fileName)
    {
       // dump($data);
        $data = ArrayToXml::convert($data);
        //dd($data);
        Storage::put($fileName, $data);

        return storage_path("app/{$fileName}");
    }
}