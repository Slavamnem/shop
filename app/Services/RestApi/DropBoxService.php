<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.11.2019
 * Time: 20:37
 */

namespace App\Services\RestApi;

use App\Components\Interfaces\DropBoxClientInterface;
use App\Services\RestApi\Interfaces\ImageStorageServiceInterface;
use Illuminate\Http\UploadedFile;

class DropBoxService implements ImageStorageServiceInterface
{
    /**
     * @var DropBoxClientInterface
     */
    private $dropBoxClient;

    public function __construct(DropBoxClientInterface $dropBoxClient)
    {
        $this->dropBoxClient = $dropBoxClient;
    }

    /**
     * @param UploadedFile $img
     * @return mixed|string
     * @throws \Exception
     */
    public function upload(UploadedFile $img)
    {
        if ($this->dropBoxClient->uploadFile($img)) {
            return $this->getUploadedImageUrl("/shop/" . $img->getClientOriginalName());
        }

        throw new \Exception("DropBox failed");
    }

    /**
     * @param $filePath
     * @return mixed
     */
    private function getUploadedImageUrl($filePath)
    {
        $response = $this->dropBoxClient->createSharedLink($filePath);

        return (str_replace("dl=0", "dl=1", $response->url));
    }
}