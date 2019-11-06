<?php

namespace App\Components\RestApi;

use App\Components\Interfaces\DropBoxClientInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class DropBox implements DropBoxClientInterface
{
    /**
     * @var
     */
    private $client;
    /**
     * @var
     */
    private $accessToken;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['connect_timeout' => 2]);
        $this->accessToken = config('api.dropbox.access-token');
    }

    /**
     * @param UploadedFile $img
     * @return string
     */
    public function uploadFile(UploadedFile $img)
    {
        return $this->request('https://content.dropboxapi.com/2/files/upload',
            [
                'headers' => [
                    'Content-Type' => 'application/octet-stream',
                    'Dropbox-API-Arg' =>  json_encode([
                        "path" => "/shop/" . $img->getClientOriginalName(),
                    ]),
                    'Authorization' => 'Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
                ],
                'body' => fopen($img->getRealPath(), 'r')
            ]
        );
    }

    /**
     * @param $filePath
     * @return string
     */
    public function createSharedLink($filePath)
    {
        return $this->request('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings',
            [
                'headers' => [
                    'contentType'   => 'application/json',
                    'Authorization' => 'Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
                ],
                'json' => [
                    "path" => $filePath,
                ]
            ]
        );
    }

    /**
     * @param $url
     * @param array $data
     * @param string $type
     * @return string
     */
    public function request($url, $data = [], $type = "POST")
    {
        try {
            return json_decode($this->client->request($type, $url, $data)
                ->getBody()
                ->getContents()
            );
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            //dump($e);
            Log::alert('Dropbox service don"t response. Message: ' . $e->getMessage()); //TODO api for logging
        }
    }
}
