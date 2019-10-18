<?php

namespace App\Services\Admin\Interfaces;

interface NewYorkTimesServiceInterface
{
    /**
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function getLastNews($count = 10);

    /**
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function getLastReviews($count = 10);
}
