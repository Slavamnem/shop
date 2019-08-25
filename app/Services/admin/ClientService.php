<?php

namespace App\Services\Admin;

use App\Client;
use App\Objects\ClientObject;
use App\Services\Admin\Interfaces\ClientServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientService implements ClientServiceInterface
{
    /**
     * @var
     */
    private $request;

    /**
     * ClientService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function getData($id)
    {
        $client = Client::with('orders')->find($id);
        $client->rating = $this->getClientRating($id);

        return ["client" => $client];
    }

    /**
     * @param $clientId
     * @return string
     */
    public function getClientRating($clientId) // TODO вычисляем рейтинг по общей сумме купленных товаров в магазе, все у кого одинаково должны иметь равный рейтинг
    {
        $clients = Client::with('orders')->get()->sortByDesc(function($client){
            return $client->orders->sum('sum');
        });

        return $this->getRatingColumn((new ClientObject())
            ->setId($clientId)
            ->setClients($clients)
        );
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredClients()
    {
        $clients = Client::query()
            ->where($this->request->input("field"),"like", "%" . $this->request->input("value") . "%")
            ->paginate(10);

        return $clients;
    }

    /**
     * @param ClientObject $clientObject
     * @return mixed
     */
    private function getClientPosition(ClientObject $clientObject)
    {
        return array_get($clientObject->getClients()->where('id', $clientObject->getId())->keys(), 0);
    }

    /**
     * @param ClientObject $clientObject
     * @return string
     */
    private function getRatingColumn(ClientObject $clientObject)
    {
        return ($this->getClientPosition($clientObject) + 1)  . "/" . count($clientObject->getClients());
    }
}
