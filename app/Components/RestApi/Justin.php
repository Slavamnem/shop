<?php

namespace App\Components\RestApi;

use App\Components\Interfaces\NovaPoshtaInterface;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Log;

class Justin
{
    /**
     * @var string
     */
    private $apiUrl;
    /**
     * @var string
     */
    private $apiLogin;
    /**
     * @var string
     */
    private $apiPassword;
    /**
     * @var
     */
    private $client;

    /**
     * Justin constructor.
     *
     *
     */
    public function __construct()
    {
        $this->apiUrl = config("api.justin.api-url");
        $this->apiLogin = config("api.justin.api-login");
        $this->apiPassword = config("api.justin.api-password");
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param null $extraFields
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCities($extraFields = null)
    {
        $requestData = [
            'contentType' => 'application/json',
            'json' => [
                "keyAccount" => "Citrus",//$this->apiLogin,
                "sign"       => "FdkKQoar",//$this->apiPassword,
                "request"    => "getData",
                "type"       => "catalog",
                "name"       => "cat_Cities",
                "language"   => "RU",
                "TOP"        => 10,
            ]
        ];

        $response = $this->request($requestData);
        //dd($response);

        return json_decode($response->getBody()->getContents());//->data;
    }

    /**
     * @param $data
     * @param string $requestType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request($data, $requestType = "POST")
    {
        try {
            return $this->client->request("POST", $this->apiUrl, $data);
        } catch (BadResponseException $exception) {
            Log::info("Justin request error");
        }
    }
}