<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DefaultNotification extends Notification
{
    use Queueable;

    /**
     * DefaultNotification constructor.
     */
    public function __construct(){}

    /**
     * @param $notifiable
     */
    public function via($notifiable)
    {
        if ($notifiable instanceof Order) {
            $this->notifyOrder($notifiable);
        }
    }

    public function notifyOrder(Order $order)
    {
        \App\Notification::create([
            'preview'     => 'Новый заказ!',
            'message'     => "Новый заказ!\nСумма: {$order->sum} \nТелефон клиента: {$order->client->phone} \nТип доставки: {$order->delivery_type->name} \nЗаказ был осуществлен: {$order->created_at}",
            'status'      => 'Новое',
            'priority_id' => 1
        ]);
    }
}
