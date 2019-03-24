<?php

namespace App\Http\Controllers;

use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramChannel;

class LearnController extends Controller
{
    public function storageLearn()
    {
        Storage::disk("public")->prepend('test-file.txt', 'Prepended Text');
        //Storage::disk("public")->put("test-file.txt", "data1111111");
        Storage::put("test-file2.txt", "data222");
        if (Storage::disk("public")->exists("test-file.txt")) {
            dump(Storage::disk("public")->get("test-file.txt"));
            dump(Storage::disk("public")->url("test-file.txt"));
            dump(Storage::disk("public")->size("test-file.txt"));
            dump(Storage::disk("public")->lastModified("test-file.txt"));
        }

        Storage::delete('test-file3.txt');

        Storage::makeDirectory("new");

        dump(Storage::allFiles());

//        Storage::copy('old/file1.jpg', 'new/file1.jpg');
//        Storage::move('old/file1.jpg', 'new/file1.jpg');
    }

    public function lang()
    {
        dump(App::getLocale());
        //dump(App::setLocale("ru"));
        dump(App::isLocale("ru"));


        dump(trans("auth.failed"));
        dump(Lang::get("auth.failed"));

        if (Lang::has("validation.after")) {
            dump(Lang::get("validation.after", ["attribute" => "name"]));
        }

        dump(Lang::choice("auth.test-pencil", 2));
    }

    public function email()
    {
        $order = Order::find(1);
        $order->notify(new NewOrderNotification());

        dd("telegram");

        /*
         Add the Telegram BOT to the group.
         Get the list of updates for your BOT:
         https://api.telegram.org/bot<YourBOTToken>/getUpdates
            {"update_id":8393,"message":{"message_id":3,"from":{"id":7474,"first_name":"AAA"},"chat":{"id":,"title":""},
            "date":25497,"new_chat_participant":{"id":71,"first_name":"NAME","username":"YOUR_BOT_NAME"}}}
            This is a sample of the response when you add your BOT into a group.
            Use the "id" of the "chat" object to send your messages.
         */

        Mail::to("dance55m@gmail.com")->send(new MailSender("Money transfer"));
        //Mail::to("dance55m@gmail.com")->cc()->send(new MailSender("Money transfer"));
        Mail::to("dance55m@gmail.com")->later(Carbon::now()->addMinutes(5), new MailSender("Money transfer"));
    }

    public function pagination()
    {
        app(Dispatcher::class)->send(Order::find(1), new NewOrderNotification());//ChannelManager::


        //$products = DB::table("products")->paginate(3);
        $products = Product::where("id", ">=", 1)->paginate(3);
        //$products->setPath("products/test");

        dump($products);

        if (view()->exists("learn.pagination")) {
            return view("learn.pagination", compact("products"));
        }

//        foreach ($products as $product) {
//            dump($product->name);
//        }
    }
}
