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
        return [
            "client"  => Client::find($id),
            "rating"  => $this->getClientRating($id),
            "profit" => $this->getClientProfit($id)
        ];
    }

    public function getClientProfit($id)
    {
        return $this->getClientsRatings()->where("id", $id)->first()->profit;
    }

    public function getClientRating($id) // TODO вычисляем рейтинг по общей сумме купленных товаров в магазе, все у кого одинаково должны иметь равный рейтинг
    {
        $clientsRatings = $this->getClientsRatings(); //dump($clientsRatings);

        return $clientsRatings->where("id", $id)->keys()[0] + 1 . "/" . count($clientsRatings);
//        $rating = 1;
//        foreach ($clientsRatings as $clientRating) {
//            if ($clientRating->id == $id){
//                //return $clientRating->rating;
//                return $rating . "/" . count($clientsRatings);
//            } else {
//                $rating++;
//            }
//        }
    }

    public function getClientsRatings()
    {
        return collect(DB::select(
            "SELECT clients.id, clients.name, clients.last_name, SUM(orders.sum) as profit
            FROM clients
            LEFT JOIN orders on clients.id = orders.client_id 
            GROUP BY clients.id, clients.name, clients.last_name
            ORDER BY profit DESC"
        ));
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
}
