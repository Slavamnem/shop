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
    public $theme;

    /**
     * Экземпляр заказа.
     *
     * @var string
     */
    public $email = "000";

    protected $template;

    /**
     * Создание нового экземпляра сообщения.
     * @param $theme
     * @param $email
     * @param $template
     * @return void
     */
    public function __construct($theme, $email, $template = "template")
    {
        $this->theme = $theme;
        $this->email = $email;
        $this->template = $template;
    }

    /**
     * Создание сообщения.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('email.template');

        return $this->view("email.{$this->template}");
            //->attach(storage_path("app/products/product_2_image.jpeg"))
//            ->with([
//                "theme"   => $this->theme,
//                "message" => "---"
//            ]);



        //text(), attach("file/to/path"), attachData($file, "filename"), with(['name'=>"Slava"), from("vzelinskiy@stud.onu.edu")
//        return $this->view('emails.orders.shipped')
//            ->with([
//                'orderName' => $this->order->name,
//                'orderPrice' => $this->order->price,
//            ]);
    }
}
