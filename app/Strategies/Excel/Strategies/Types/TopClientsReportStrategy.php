<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:14
 */

namespace App\Strategies\Excel\Strategies\Types;

use App\Builders\Interfaces\DocumentBuilderInterface;
use App\Client;
use App\Objects\CreateReportRequestObject;
use App\Order;
use App\Strategies\Interfaces\ExcelReportStrategyInterface;
use Carbon\Carbon;

class TopClientsReportStrategy extends AbstractReportTypeStrategy implements ExcelReportStrategyInterface
{
    /**
     * @param DocumentBuilderInterface $builder
     * @param CreateReportRequestObject $requestObject
     * @return mixed
     */
    public function setReportData(DocumentBuilderInterface $builder, CreateReportRequestObject $requestObject)
    {
        $this->initialize($builder, $requestObject);

        $clients = $this->getClients()->map(function($client){
            return [
                'Имя'     => $client->name,
                'Фамилия' => $client->last_name,
                'Телефон' => $client->phone,
                'Почта'   => $client->email,
                'Прибыль' => $client->profit,
            ];
        });

        if ($clients->isNotEmpty()) {
            $builder->addRow(array_keys($clients->first()), 1);
        }

        foreach ($clients->values() as $key => $client) {
            $builder->addRow($client, $key + 2);
        }
    }

    /**
     * @return string
     */
    public function getReportName()
    {
        return 'top_clients_report' . Carbon::now()->format('Y_m_d');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getClients()
    {
        $clients = Client::query()->with(['orders' => function($query){
            return $query->where('created_at', '>=', $this->requestObject->getFromDate())
                ->where('created_at', '<=', $this->requestObject->getTillDate());
        }])->get();

        foreach ($clients as $client) {
            $client->profit = $client->orders->sum('sum');
        }

        $clients = $clients->sortByDesc('profit');

        return $clients;
    }
}
