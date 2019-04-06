<?php

namespace App\Components\Interfaces;

interface SaveDataToFileInterface
{
    /**
     * @param array $data
     * @param string $fileName
     * @return string
     */
    public function saveToFile(array $data, $fileName);
}