<?php

namespace App\Components\RestApi;

use Illuminate\Support\Facades\Log;

class NewYorkTimes
{
    /**
     * @var
     */
    private $client;
    /**
     * @var
     */
    private $apiKey;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['connect_timeout' => 2]);
        $this->apiKey = config('api.new-york-times.api-key');
    }

    /**
     * @return array
     */
    public function getLatestTopArticles()
    {
        return $this->request('svc/mostpopular/v2/viewed/1.json?api-key=' . $this->apiKey, [], 'GET')->results;
    }

    /**
     * @return array
     */
    public function getLatestTopReviews()
    {
        return $this->request('svc/movies/v2/reviews/search.json?api-key=' . $this->apiKey, [], 'GET')->results;
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
            return json_decode($this->client->request($type, config('api.new-york-times.base-url') . $url, $data)
                ->getBody()
                ->getContents()
            );
        } catch(\GuzzleHttp\Exception\GuzzleException $e) {
            dump($e);
            Log::alert('NewYorkTimes service don"t response');
        }
    }
}
