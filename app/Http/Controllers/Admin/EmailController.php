<?php

namespace App\Http\Controllers\Admin;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function newEmail(Request $request)
    {
        $data = [
            "login" => env("MAIL_USERNAME"),
            "password" => env("MAIL_PASSWORD"),
            "email" => $request->input("email", "Ошибка"),
        ];

        return view("email.email", $data);
    }

    public function sendEmail(Request $request)
    {
        Mail::to($request->input("receiver_email"))->send(new MailSender(
            "Уведомление от MilanShop",
            $request->input("message"),
            "order-answer"
        ));

        return redirect()->route("admin-orders");
    }
}
