<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewOrderEvent;
use App\Mail\MailSender;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use App\Services\Admin\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function __construct()
    {
        View::share("activeMenu", "products");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['color', 'size', 'category'])->get();

        return view("admin.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ProductService::getDataForProductPage();

        return view("admin.products.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->fill($request->only($product->getFillable()));
        ProductService::saveImages($request, $product);

        $product->save();

        return redirect()->route("admin-products-edit", ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ProductService::getDataForProductPage($id);

        return view("admin.products.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProductService::getDataForProductPage($id);

        return view("admin.products.edit", $data);
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
        $product = Product::find($id);

        $product->fill($request->only($product->getFillable()));
        ProductService::saveImages($request, $product);

        $product->save();

        return redirect()->route("admin-products-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route("admin-products");
    }

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
}
