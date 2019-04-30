<?php

namespace App\Components\Interfaces;

interface SaveDataToFileInterface
{
    /**
     * @param $data
     * @param $fileName
     * @param $nestedItemName
     * @return mixed
     */
    public function saveToFile($data, $fileName, $nestedItemName);
}