<?php

namespace App\Notifications;

use App\AdminAuth;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class AttackNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @return void
     */
    public function __construct(){}

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

    public function toTelegram(AdminAuth $adminAuth)
    {
        $content = "Атака! Попытка взлома сайта! Закрываю доступ к админ панели.";

        return TelegramMessage::create()
            ->to(273791920)  //OrderBot (only me)
            //->to(-1001455732336) //Заказы MilanShop
            //->to(-217503824) //Бизнес конференция
            ->content($content);
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
