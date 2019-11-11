<?php

namespace App\Exports;

use App\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection // unused, for test
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::all();

        $orders->transform(function($order){
            $order->status_id = $order->status->name;
            return $order;
        });

        return $orders;

        return new Collection([['id', 'name'], [5, 'Slava']]);
    }
}
