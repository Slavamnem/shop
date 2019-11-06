<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.11.2019
 * Time: 20:40
 */

namespace App\Services\RestApi\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImageStorageServiceInterface
{
    /**
     * @param UploadedFile $img
     * @return string
     */
    public function upload(UploadedFile $img);
}
