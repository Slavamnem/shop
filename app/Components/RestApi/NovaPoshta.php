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

    public function getOrderPrice($extraFields = null)
    {
        $requestData = [
            'contentType' => 'application/json',
            'json' => [
                "modelName"        => "InternetDocument",
                "calledMethod"     => "getDocumentPrice",
                "methodProperties" => $extraFields,
                "apiKey"           => $this->apiKey
            ]
        ];

        $response = $this->request($requestData);

        return json_decode($response->getBody()->getContents())->data;
    }

    /**
     * @param null $extraFields
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
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

        return json_decode($response->getBody()->getContents())->data;
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
                "modelName"        => "Address",
                "calledMethod"     => "getCities",
                "methodProperties" => $extraFields,
                "apiKey"           => $this->apiKey
            ]
        ];

        $response = $this->request($requestData);

        return json_decode($response->getBody()->getContents())->data;
    }

    /**
     * @param null $extraFields
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSettlements($extraFields = null)
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
            Log::info("Nova Poshta request error");
        }
    }
}