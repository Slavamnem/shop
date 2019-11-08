<?php

namespace App\Http\Controllers\Admin;

use App\Components\Interfaces\EmailDriverInterface;
use App\Mail\MailSender;
use App\Objects\SendEmailsRequestObject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * @var EmailDriverInterface
     */
    private $emailDriver;

    /**
     * EmailController constructor.
     * @param EmailDriverInterface $emailDriver
     */
    public function __construct(EmailDriverInterface $emailDriver)
    {
        $this->emailDriver = $emailDriver;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newEmail(Request $request) //TODO
    {
        $data = [
            "login" => env("MAIL_USERNAME"),
            "password" => env("MAIL_PASSWORD"),
            "email" => $request->input("email", "Ошибка"),
        ];

        return view("email.email", $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request)
    {
        $this->emailDriver->send((new SendEmailsRequestObject())
            ->addReceiver($request->input("receiver_email"))
            ->setSubject("Уведомление от MilanShop!!!")
            ->setMessage($request->input("message"))
            ->setTemplate("order-answer")
        );

        return redirect()->route("admin-orders");
    }
}
