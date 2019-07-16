<?php

namespace App\Services\Admin;

use App\Client;
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
        $client = Client::with('orders')->where('id', $id)->first();
        $client->rating = $this->getClientRating($id);

        return ["client" => $client];
    }

    /**
     * @param $id
     * @return string
     */
    public function getClientRating($id) // TODO вычисляем рейтинг по общей сумме купленных товаров в магазе, все у кого одинаково должны иметь равный рейтинг
    {
        $clients = Client::with('orders')->get()->sortByDesc(function($client){
            return $client->orders->sum('sum');
        });

        $clientPosition = $clients->where('id', $id)->keys()[0];

        return ($clientPosition + 1)  . "/" . count($clients);
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

//    /**
////     * @return \Illuminate\Support\Collection
////     */
////    public function getClientsRatings()
////    {
////        return collect(DB::select(
////            "SELECT clients.id, clients.name, clients.last_name, SUM(orders.sum) as profit
////            FROM clients
////            LEFT JOIN orders on clients.id = orders.client_id
////            GROUP BY clients.id, clients.name, clients.last_name
////            ORDER BY profit DESC"
////        ));
////    }
}
