<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Экземпляр заказа.
     *
     * @var string
     */
    protected $theme;

    /**
     * Создание нового экземпляра сообщения.
     *
     * @return void
     */
    public function __construct($theme)
    {
        $this->theme = $theme;
    }

    /**
     * Создание сообщения.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('email.template');

        return $this->view("email.template")
            ->attach(storage_path("app/products/product_2_image.jpeg"))
            ->with([
                "theme" => $this->theme,
                "name" => "Slava",
                "age" => 25
            ]);

        //text(), attach("file/to/path"), attachData($file, "filename"), with(['name'=>"Slava"), from("vzelinskiy@stud.onu.edu")
//        return $this->view('emails.orders.shipped')
//            ->with([
//                'orderName' => $this->order->name,
//                'orderPrice' => $this->order->price,
//            ]);
    }
}