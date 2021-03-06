<?php

namespace App\Services\Admin\Interfaces;

use App\Client;

interface OrderServiceInterface
{
    /**
     * @return Client
     */
    public function getClient();

    /**
     * @param Client $client
     */
    public function setClient(Client $client);

    /**
     * @return mixed
     */
    public function getOrder();

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredOrders();

    /**
     * @param $id
     * @return array
     */
    public function getData($id = null);

    public function createOrder(): void;

    public function saveOrderClient(): void;

    public function saveOrder(): void;

    public function saveOrderProducts(): void;
}
