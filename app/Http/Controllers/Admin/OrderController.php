<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryType;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\OrderStatus;
use App\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function __construct()
    {
        View::share("activeMenu", "orders");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view("admin.orders.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.orders.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();

        $order->fill($request->only($order->getFillable()));
        $order->save();

        return redirect()->route("admin-orders-edit", ['id' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = [
            "order"          => Order::find($id),
            "statuses"       => OrderStatus::all(),
            "payment_types"  => PaymentType::all(),
            "delivery_types" => DeliveryType::all(),
            "url"            => env("DOMAIN_NAME") . "/" . $request->path()
        ];

        return view("admin.orders.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = [
            "order"          => Order::find($id),
            "statuses"       => OrderStatus::all(),
            "payment_types"  => PaymentType::all(),
            "delivery_types" => DeliveryType::all(),
            "url"            => env("DOMAIN_NAME") . "/" . $request->path()
        ];

        return view("admin.orders.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $order->fill($request->only($order->getFillable()));

        $order->save();

        return redirect()->route("admin-orders-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Order::find($id);
        $group->delete();

        return redirect()->route("admin-orders");
    }

    //

    public function pushToTelegram(Request $request, $id)
    {
        $order = Order::find($id);
        $order->notify(new NewOrderNotification($request->input("link")));

        //return json_encode($request->input("link"));
        //return redirect()->route("admin-orders-edit", ['id' => $order->id]);
    }

    public function email(Request $request)
    {
        $data = [
            "login" => env("MAIL_USERNAME"),
            "password" => env("MAIL_PASSWORD"),
            "email" => $request->input("email", "Ошибка"),
        ];

        return view("admin.orders.email", $data);
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
