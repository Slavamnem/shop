<?php

namespace App\Services\Admin\Interfaces;

interface ClientServiceInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getData($id);

    /**
     * @return mixed
     */
    public function getFilteredClients();
}
