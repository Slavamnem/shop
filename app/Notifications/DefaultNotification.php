<?php

namespace App\Notifications;

use App\Enums\PrioritiesEnum;
use App\Order;
use App\User;
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
        } elseif ($notifiable instanceof User) {
            $this->notifyLogin($notifiable);
        }
    }

    private function notifyOrder(Order $order)
    {
        \App\Notification::create([
            'preview'     => 'Новый заказ!',
            'message'     => "Новый заказ!\nСумма: {$order->sum} \nТелефон клиента: {$order->client->phone} \nТип доставки: {$order->delivery_type->name} \nЗаказ был осуществлен: {$order->created_at}",
            'status'      => 'active',
            'priority_id' => PrioritiesEnum::HIGH
        ]);
    }

    private function notifyLogin(User $user)
    {
        if (isset($user->name) or isset($user->last_name)) {
            $message = "Пользователь " . trim($user->name . " " . $user->last_name) . " вошел в админ-панель.";
        } else {
            $message = "Попытка входа в админ-панель\nЛогин: {$user->login}\nПароль: {$user->password}";
        }

        \App\Notification::create([
            'preview'     => 'Вход в админ-панель',
            'message'     => $message,
            'status'      => 'active',
            'priority_id' => PrioritiesEnum::LOW
        ]);
    }
}
