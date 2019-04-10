<?php

namespace App\Components\RestApi;

use App\Components\Interfaces\NovaPoshtaInterface;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Log;

class NovaPoshta implements NovaPoshtaInterface
{
    /**
     * @var
     */
    private $apiUrl;
    /**
     * @var
     */
    private $apiKey;
    /**
     * @var
     */
    private $client;

    /**
     * NovaPoshta constructor.
     * https://my.novaposhta.ua/settings/index#apikeys
     * https://devcenter.novaposhta.ua/docs/services/
     */
    public function __construct()
    {
        $this->apiUrl = config("api.nova-poshta.api-url");
        $this->apiKey = config("api.nova-poshta.api-key");
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param null $extraFields
     * @return mixed
     */
    public function getWarehouses($extraFields = null)
    {
        $requestData = [
            'contentType' => 'application/json',
            'json' => [
                "modelName"        => "AddressGeneral",
                "calledMethod"     => "getWarehouses",
                "methodProperties" => $extraFields,
                "apiKey"           => $this->apiKey
            ]
        ];

        $response = $this->request($requestData);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param null $extraFields
     * @return mixed
     */
    public function getCities($extraFields = null)
    {
        $requestData = [
            'contentType' => 'application/json',
            'json' => [
                "modelName"        => "AddressGeneral",
                "calledMethod"     => "getSettlements",
                "methodProperties" => $extraFields,
                "apiKey"           => $this->apiKey
            ]
        ];

        $response = $this->request($requestData);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param array $data
     * @param string $requestType
     * @return mixed
     */
    private function request($data, $requestType = "POST")
    {
        try {
            return $this->client->request("POST", $this->apiUrl, $data);
        } catch(BadResponseException $exception) {
            Log::info("Nova Poshta request error");
        }
    }
}