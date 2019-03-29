<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    private $link;
    /**
     * Create a new notification instance.
     * @param string $link
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram(Order $order)
    {
        $content = "Новый заказ!\nСумма: {$order->sum} \nТелефон клиента: {$order->phone} \nТип доставки: {$order->delivery_type->name} \nЗаказ был осуществлен: {$order->created_at}";
        //$file = Storage::get("products/product_2_image.jpeg");
        //dump($file);
        //$content .= $file;

        return TelegramMessage::create()
            ->to(273791920)  //OrderBot (only me)
            //->to(-1001455732336) //Заказы MilanShop
            //->to(-217503824) //Бизнес конференция
            ->content($content)
            //->file(storage_path("app/products/product_2_image.jpeg"), 'photo')
            ->button('Download PDF', $this->link);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
