<?php

namespace App\Http\Controllers;

use App\Color;
use App\Events\NewOrderEvent;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use InstagramAPI\Instagram;
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

    public function redis()
    {
        Redis::set("test", 77);

        if (Redis::exists("test")) {
            dump(Redis::get("test"));
        }
    }

    public function session(Request $request)
    {
        $color = new Color();
        $color->name = "red";
        //Cache::put("c", $color, 100);
        $color = Cache::get("c");
        //dump($color->name);

        ///////////////
        $request->session()->put("a", 10);
        $request->session()->put("b", 40);
        $request->session()->put("c", 770);
        $request->session()->put("users.slava", ["name" => "Slava", "age" => 22]);
        $request->session()->push("numbers", 7);

        dump($request->session()->pull("c"));

        if ($request->session()->has("a")) {
            dump($request->session()->get("a", "none"));
        }

        $request->session()->forget("b");
        $request->session()->flush();

        dump($request->session()->all());

        //$request->session()->flash("Status", "success");
        //$request->session()->reflash();
    }

    public function insta()
    {
        dump("insta");

        $debug = false;
        $truncatedDebug = false;

        ob_start();
        $insta = new Instagram($debug, $truncatedDebug);
        $text = ob_get_clean();

        try {
            $insta->login("slovi_channel", "slava2971765");
            dump("success!");

            try {
                $photo = new \InstagramAPI\Media\Photo\InstagramPhoto(storage_path("app/products/product_2_image.jpeg"));
                $insta->timeline->uploadPhoto($photo->getFile(), ['caption' => ""]);
//                $feed = $insta->discover->getExploreFeed();
//                // Let's begin by looking at a beautiful debug output of what's available in
//                // the response! This is very helpful for figuring out what a response has!
//                $feed->printJson();
//                // Now let's look at what properties are supported on the $feed object. This
//                // works on ANY object from our library, and will show what functions and
//                // properties are supported, as well as how to call the functions! :-)
//                $feed->printPropertyDescriptions();
//                // The getExploreFeed() has an "items" property, which we need. As we saw
//                // above, we should get it via "getItems()". The property list above told us
//                // that it will return an array of "Item" objects. Therefore it's an ARRAY!
//                $items = $feed->getItems();
//                // Let's get the media item from the first item of the explore-items array...!
//                $firstItem = $items[0]->getMedia();
//                // We can look at that item too, if we want to... Let's do it! Note that
//                // when we list supported properties, it shows everything supported by an
//                // "Item" object. But that DOESN'T mean that every property IS available!
//                // That's why you should always check the JSON to be sure that data exists!
//                $firstItem->printJson(); // Shows its actual JSON contents (available data).
//                $firstItem->printPropertyDescriptions(); // List of supported properties.
//                // Let's look specifically at its User object!
//                $firstItem->getUser()->printJson();
//                // Okay, so the username of the person who posted the media is easy... And
//                // as you can see, you can even chain multiple function calls in a row here
//                // to get to the data. However, be aware that sometimes Instagram responses
//                // have NULL values, so chaining is sometimes risky. But not in this case,
//                // since we know that "user" and its "username" are always available! :-)
//                $firstItem_username = $firstItem->getUser()->getUsername();
//                // Now let's get the "id" of the item too!
//                $firstItem_mediaId = $firstItem->getId();
//                // Finally, let's get the highest-quality image URL for the media item!
//                $firstItem_imageUrl = $firstItem->getImageVersions2()->getCandidates()[0]->getUrl();
//                // Output some statistics. Well done! :-)
//                echo 'There are '.count($items)." items.\n";
//                echo "The first item has media id: {$firstItem_mediaId}.\n";
//                echo "The first item was uploaded by: {$firstItem_username}.\n";
//                echo "The highest quality image URL is: {$firstItem_imageUrl}.\n";
            } catch (\Exception $e) {
                echo 'Something went wrong: '.$e->getMessage()."\n";
            }

        } catch (\Exception $e) {
            dump("error!");
        }
    }

    public function blade()
    {
        $name = "slava";
        $peoples = ["Slava", "Olga", "Tom", "Jon"];
        return view("test", compact('name', 'peoples'));
    }



    //
    public function api1()
    {
        return [
            [
                "name" => "Apple X",
                "price" => 3000
            ]
        ];

//        return json_encode(["data"=>[
//            "name" => "Apple X",
//            "price" => 3000
//        ]]);
//        return response()->json([
//            "data" => [
//                "name" => "Apple X",
//                "price" => 3000
//            ]
//        ]);
    }

    public function api2()
    {
//        Response::success([
//            "name" => "Apple X",
//            "price" => 3000
//        ]);
    }

    public function api3()
    {

    }

    public function testF1()
    {
        $totalPrice = Product::all()->count("price");
        return 57;
        return $totalPrice;
    }

    public function testF2()
    {
        Event::fire(new NewOrderEvent("test123"));

        return "user-login: " . Auth::user()->login;
        //return 77;
    }
}
