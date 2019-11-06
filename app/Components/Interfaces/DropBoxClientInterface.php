<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.11.2019
 * Time: 20:40
 */

namespace App\Components\Interfaces;

use Illuminate\Http\UploadedFile;

interface DropBoxClientInterface
{
    /**
     * @param UploadedFile $img
     * @return string
     */
    public function uploadFile(UploadedFile $img);

    /**
     * @param $filePath
     * @return string
     */
    public function createSharedLink($filePath);
}
