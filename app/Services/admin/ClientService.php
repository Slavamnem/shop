<?php

namespace App\Services\Admin;

use App\Client;
use App\Services\Admin\Interfaces\ClientServiceInterface;

class ClientService implements ClientServiceInterface
{
    public function getData($id)
    {
        return [
            "client" => Client::find($id)
        ];
    }

    public function getFilteredClients()
    {

    }
}
