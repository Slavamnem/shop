<?php

namespace App\Components\RestApi;

use Illuminate\Support\Facades\Log;

class Exchange
{
    /**
     * @var
     */
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['connect_timeout' => 0.25]);
    }

    /**
     * @param string $base
     * @param string $target
     * @return mixed
     */
    public function getRate($base = "USD", $target = "UAH")
    {
        return @$this->getRates($base)->$target;
    }

    /**
     * @param string $base
     * @return mixed
     */
    public function getRates($base = "USD")
    {
        try {
            return json_decode(
                $this->client->get(config('api.exchange-url') . $base)
                    ->getBody()
                    ->getContents()
            )->rates;
        } catch(\Exception $e) {
            Log::alert('exchange service don"t response');
        }
    }
}
