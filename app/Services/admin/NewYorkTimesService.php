<?php

namespace App\Services\Admin;

use App\Components\RestApi\NewYorkTimes;
use App\Services\Admin\Interfaces\NewYorkTimesServiceInterface;

class NewYorkTimesService implements NewYorkTimesServiceInterface
{
    /**
     * @var NewYorkTimes
     */
    private $newYorkTimesApi;

    public function __construct()
    {
        $this->newYorkTimesApi = new NewYorkTimes();
    }

    /**
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function getLastNews($count = 10)
    {
        return collect(array_slice($this->newYorkTimesApi->getLatestTopArticles(), 0, $count))->map(function($new){
            $new->mainImage = @get_object_vars(@$new->media[0])['media-metadata'][0]->url;
            return $new;
        });
    }

    /**
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function getLastReviews($count = 10)
    {
        return collect(array_slice($this->newYorkTimesApi->getLatestTopReviews(), 0, $count));
    }
}
