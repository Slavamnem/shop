<?php

namespace App\Http\Controllers;

use App\Color;
use App\Components\RestApi\Exchange;
use App\Components\RestApi\NewYorkTimes;
use App\Components\RestApi\NovaPoshta;
use App\Events\NewOrderEvent;
use App\Notifications\NewOrderNotification;
use App\Order;
use App\Product;
use App\Services\ElasticSearchService;
use GuzzleHttp\Client;
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
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Hydrator\ArrayHydrator;
use Mailgun\Mailgun;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramChannel;

class LearnController extends Controller
{
    public function drop()
    {
        try {
            $client = new Client();

            $response = $client->post('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings', [
                'headers' => [
                    'contentType' => 'application/json',
                    'Authorization' => 'Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
                ],
                'json' => [
                    "path" => "/test6/test4.jpg",
                ]
            ]);
//            $response = $client->post('https://api.dropboxapi.com/2/files/create_folder_v2', [
//                'headers' => [
//                    'contentType' => 'application/json',
//                    'Authorization' => 'Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
//                ],
//                'json' => [
//                    "path" => "/test4/test4",
//                ]
//            ]);

//            $response = $client->post('https://content.dropboxapi.com/2/files/upload', [
//                'headers' => [
//                    'Content-Type' => 'application/octet-stream',
//                    'Dropbox-API-Arg' =>  json_encode([
//                        "path" => "/test5/test.jpg",
//                        "mode" => "add",
//                        "autorename" => true,
//                        "mute" => false,
//                        "strict_conflict" => false
//                    ]),
//                    'Authorization' => 'Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
//                ],
//                'json' => [
//                    "path" => "/test5/test.jpg",
//                ],
//                'multipart' => [
//                    [
//                        'name' => 'testfile',
//                        'contents' => file_get_contents('https://glavcom.ua/img/article/5339/69_main.jpg'),
//                    ]
//                ]
//            ]);

            dump($response);
            dump($response->getBody()->getContents());
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

    private function saveToDropBox($img)
    {
        $client = new Client();

        //dump($img);
        //dd($_FILES);
        $response = $client->post('https://content.dropboxapi.com/2/files/upload', [
            'headers' => [
                'Content-Type' => 'application/octet-stream',
                'Dropbox-API-Arg' =>  json_encode([
                    "path" => "/test6/test3.jpg",
                ]),
                'Authorization' => 'Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
            ],
//            'json' => [
//                "path" => "/test5/test2.jpg",
//            ],
            'body' => fopen('https://spacenews.com/wp-content/uploads/2018/05/24359364107_152b0152ff_k-879x485.jpg', 'r'),
//            'multipart' => [
//                [
//                    'name' => 'test1.jpg',
//                    //'contents' => $img,
//                    'contents' => fopen('https://spacenews.com/wp-content/uploads/2018/05/24359364107_152b0152ff_k-879x485.jpg', 'r'),
//                    //'contents' => fopen($img->getRealPath(), 'r'),
//                    'filename' => $img->getClientOriginalName()
//                ]
//            ]
        ]);

        dd($response->getBody()->getContents());
    }

    function drive()
    {
        # Instantiate the client.
        $configurator = new HttpClientConfigurator();
        $configurator->setApiKey('9da1a302b83a027ad4ca7575fc14129c-f696beb4-eae61afe');

        $mgClient = new Mailgun($configurator, new ArrayHydrator());
        //$mgClient = new Mailgun('f696beb4-eae61afe');
        $domain = "sandboxde06fcca8afb407cbfc34954a3241b2e.mailgun.org";

        # Make the call to the client.
        $result = $mgClient->messages()->send($domain, [
            'from'    => 'vzelinskiy@stud.onu.edu.ua',
            'to'      => 'vzelinskiy@stud.onu.edu.ua',
            'subject' => 'The PHP SDK is awesome!',
            'text'    => 'It is so simple to send a message2.'
        ]);
//        $result = $mgClient->sendMessage("$domain",
//            array('from'    => 'Mailgun Sandbox <postmaster@sandboxde06fcca8afb407cbfc34954a3241b2e.mailgun.org>',
//                'to'      => 'Viacheslav <vzelinskiy@stud.onu.edu.ua>',
//                'subject' => 'Hello Viacheslav',
//                'text'    => 'Congratulations Viacheslav, you just sent an email with Mailgun!  You are truly awesome! '));

        dd($result);
// You can see a record of this email in your logs: https://app.mailgun.com/app/logs.

    }

    function getClient()
    {
        $client = new \Google_Client();
        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setScopes(\Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setAuthConfig('./storage/app/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new \Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    public function drive2()
    {
        $client = $this->getClient();
        dd($client);
        $service = new \Google_Service_Drive($client);

// Print the names and IDs for up to 10 files.
        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)'
        );
        $results = $service->files->listFiles($optParams);

        if (count($results->getFiles()) == 0) {
            print "No files found.\n";
        } else {
            print "Files:\n";
            foreach ($results->getFiles() as $file) {
                printf("%s (%s)\n", $file->getName(), $file->getId());
            }
        }

        /*
       // dd(file_get_contents('./storage/app/credentials.json'));
        $client = new \Google_Client();
        $client->setAuthConfig('./storage/app/credentials.json');
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setIncludeGrantedScopes(true);

        $client->addScope(\Google_Service_Drive::DRIVE_FILE, \Google_Service_Drive::DRIVE_APPDATA, \Google_Service_Drive::DRIVE, \Google_Service_Drive::DRIVE_METADATA);
        $accessToken = json_decode(file_get_contents('./storage/app/credentials.json'), true);
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents('credentials.json', json_encode($client->getAccessToken()));
        }

        $service = new \Google_Service_Drive($client);
        $results = $service->files->listFiles();
        dd($results);
        $fileId = 'yourfileid';
        $file = $service->files->get($fileId, array('alt' => 'media'));
        file_put_contents("hello.pdf",$file->getBody());

       // return view('learn.index');*/
    }

    public function elastic()
    {
        dump((new NewYorkTimes())->getLatestTopArticles());
        dump('elastic');

        return 'end';

        $elasticService = new ElasticSearchService();

        $params['index'] = 'product';
        $params['body'] = [
            'size' => 3,
            'from' => 0,
            'sort' => [
                'base_price' => [
                    'order' => 'desc'
                ]
            ],
            '_source' => $this->getSource(),
            'query' => [
                'bool' => [
                    'must_not' => [
                        [
                            'term' => [
                                'quantity' => 11
                            ]
                        ]
                    ],
                    'must' => [
                        [
                            'terms' => [
                                'category.id' => [1, 3]
                            ]
                        ],
                        [
//                            'match' => [
//                                //'name' => 'белый XLL',
//                                'name' => [
//                                    'query' => 'белый XLL',
//                                    'operator' => 'or'
//                                ]
//                            ],
//                            'match_phrase' => [
//                                'name' => [
//                                    'query' => 'Test белый',
//                                    'slop' => 2
//                                ]
//                            ],
                            'multi_match' => [
                                'query' => 'Test белый Футболки',
                                'fields' => [
                                    'name', 'category.name'
                                ]
                            ]
                        ],
                        [
                            'wildcard' => [
                                'color.name' => 'бе?ый'
                            ]
                        ],
                        [
                            'exists' => [
                                'field' => 'category.name'//description
                            ]
                        ],
                        [
                            'bool' => [
                                'should' => [
                                    [
                                        'range' => [
                                            'base_price' => [
                                                'lte' => 280
                                            ],
                                        ]
                                    ],
                                    [
                                        'range' => [
                                            'created_at' => [
                                                'gte' => '2019-10-04 00:00:00'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'script_fields' => [
                'real_price' => [
                    'script' => [
                        'source' => "params['_source']['base_price'] - 10"
                    ]
                ]
            ],
            'post_filter' => [
                'bool' => [
                    'must' => [
                        [
                            'term' => [
                                'category.id' => 1
                            ]
                        ],
                        [
                            'terms' => [
                                'base_price' => [0, 270]
                            ]
                        ]
                    ]
                ]
            ],
            'aggs' => [
                'avg_price' => [
                    'avg' => [
                        'field' => 'base_price'
                    ]
                ],
                'max_price' => [
                    'max' => [
                        'field' => 'base_price'
                    ]
                ],
                'sum_quantity' => [
                    'sum' => [
                        'field' => 'quantity'
                    ]
                ],
                'my hits' => [
                    'top_hits' => [
                        'size' => 2,
                        'from' => 1,
                        //'sort'
                    ]
                ],
                'cats' => [
                    'terms' => [
                        'field' => 'category.id',
//                        'order' => [
//                            'base_price' => 'asc'
//                        ]
                    ],
                    'aggs' => [
                        'cats-tops' => [
                            'top_hits' => [
                                '_source' => ['name', 'base_price'],
                                'size' => 10
                            ]
                        ],
                        'avg_price' => [
                            'avg' => [
                                'field' => 'base_price'
                            ]
                        ]
                    ]
                ],
                'multi_filtered_products' => [
                    'filters' => [
                        'filters' => [
                            'price-filter' => [
                                'term' => [
                                    'base_price' => 270
                                ]
                            ]
                        ]
                    ],
                    'aggs' => [
                        'tops' => [
                            'top_hits' => [
                                'size' => 10,
                                '_source' => ['name', 'base_price']
                            ]
                        ]
                    ]
                ],
                'filtered_products' => [
                    'filter' => [
//                        'terms' => [
////                            'quantity' => [1, 10],
////                            //'base_price' => 270
////                        ],
//                        'range' => [
//                            'quantity' => [
//                                'gte' => 3
//                            ]
//                        ],
                        'bool' => [
                            'must' => [
                                [
                                    'term' => [
                                        'category.id' => 1
                                    ]
                                ],
                                [
                                    'terms' => [
                                        'base_price' => [0, 270]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'aggs' => [
                        'avg_price' => [
                            'avg' => [
                                'field' => 'base_price'
                            ]
                        ],
                        'tops' => [
                            'top_hits' => [
                                'size' => 10
                            ]
                        ]
                    ]
                ],
                'ranges_products' => [
                    'range' => [
                        'field' => 'base_price',
                        'ranges' => [
                            ['from' => 0, 'to' => 100, 'key' => 'cheap'],
                            ['from' => 101, 'to' => 250, 'key' => 'middle'],
                            ['from' => 251, 'to' => 500, 'key' => 'expensive'],
                        ]
                    ],
                    'aggs' => [
                        'tops' => [
                            'top_hits' => [
                                'size' => 3,
                                '_source' => ['name', 'base_price']
                            ]
                        ]
                    ]
                ]
            ]
        ];

        echo "<pre>";
        print_r($elasticService->searchByQuery($params));
        echo "</pre>";
    }

    public function planfix()
    {
        dump('planfix');

        $client = new \GuzzleHttp\Client();

        $apiUrl = 'https://test.planfix.ru/chat/api';
        $apiUrl = 'https://milanshop.planfix.ru/webchat/api';

        $requestData = [
            'Content-Type' => 'application/json',
            'User-Agent' => 'PostmanRuntime/7.17.1',
            'Accept' => '*/*',
            'Cache-Control' => 'no-cache',
            'Postman-Token' => '475f8e16-18ed-45c0-832e-40ef0e251a05',
            'Host' => 'milanshop.planfix.ru',
            'Accept-Encoding' => 'gzip, deflate',
            'Content-Length' => 0,
            'Connection' => 'keep-alive',
            'json' => [
                'cmd'=>'newMessage',
                'providerId'=>'support',
                'chatId'=>'29712971',
                'planfix_token'=>'f41a5a224ca6e611c2a155e18ba0b378',
                'message'=>'Здравствуйте, есть вопрос',
                'contactId'=>'57487124',
                'contactName'=>'Иван',
                'contactLastName'=>'Иванов',
                'contactIco'=>'https://superchat.io/avatars/183712.png',
                'contactEmail'=>'ivan@ivanov.com',
                'contactPhone'=>'79051234567',
                'contactData'=>'пришёл по запросу газовые котлы',
            ]
        ];

        try {
            dump('before');
            dump($client->request('POST', $apiUrl, $requestData));

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            dump($e->getMessage());
            // Catch all 4XX errors

            // To catch exactly error 400 use
            if ($e->getResponse()->getStatusCode() == '400') {
                echo "Got response 400";
            }

            // You can check for whatever error status code you need

        } catch (\Exception $e) {

            // There was another exception.

        }

    }

    public function getSource()
    {
        return [
            'name',
            'slug',
            'base_price',
            'quantity',
            'category',
            //'model',
            'size',
            'color',
            'properties',
            //'images',
            //'description',
            'created_at'
        ];
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

    public function getPdo()
    {
        $host = "localhost";
        $login = "root";
        $password = "";
        $dbName = "shop";
        $charset = "utf8";

        $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new \PDO($dsn, $login, $password, $opt);
    }

    public function selectSql()
    {
        $pdo = $this->getPdo();

        $sql = "SELECT DISTINCT url, main, preview, ordering, created_at FROM product_images";
        $sql = "SELECT name, slug, base_price, quantity, category_id, status_id 
            FROM products 
            ORDER BY base_price, quantity";
        $sql = "SELECT name, slug, base_price, quantity, category_id, status_id 
            FROM products 
            WHERE quantity >= 1
            ORDER BY base_price, quantity";
            //GROUP BY base_price";

        $sql = "SELECT name, slug, base_price, quantity, category_id, status_id, created_at
            FROM products 
            WHERE quantity >= 1
            ORDER BY MONTH(created_at)";

        $sql = "SELECT name, slug, base_price, quantity, category_id, status_id 
            FROM products 
            WHERE quantity >= 1
            AND base_price BETWEEN 150 AND 300";

        $sql = "SELECT name, slug, base_price, quantity, category_id, status_id 
            FROM products 
            WHERE quantity >= 1
            AND base_price IN(150, 160, 270)";

        $sql = "SELECT name, slug, base_price, quantity, category_id, status_id 
            FROM products 
            WHERE quantity >= 1
            AND status_id IN (SELECT id FROM product_statuses WHERE product_statuses.name LIKE '%В наличии%')";

        $sql = "SELECT name as ИМЯ, slug
            FROM products";

        $sql = "SELECT name, slug
            FROM products
            WHERE name LIKE '%X_L'";

        $sql = "SELECT name, slug
            FROM products
            WHERE small_image IS NOT NULL";

        $sql = "SELECT SUM(base_price) AS total_price, AVG(base_price) AS avarage_price
            FROM products";

        $sql = "SELECT status_id, SUM(base_price), SUM(quantity)
            FROM products
            GROUP BY status_id, base_price WITH ROLLUP
            HAVING SUM(quantity) > 25";

        $sql = "SELECT * FROM products 
            WHERE created_at IS NOT NULL
            ORDER BY created_at";

        $sql = "SELECT MAX(base_price) FROM 
            (
            SELECT status_id, SUM(base_price) AS base_price, SUM(quantity)
            FROM products
            GROUP BY status_id
            ) X";

        $sql = "SELECT p.name, p.base_price, p.quantity, c.name as CAT_NAME
        FROM products AS p, categories as c
        WHERE p.category_id = c.id";

        $sql = "SELECT client_id, SUM(sum) as Sum
        FROM orders
        GROUP BY client_id
        HAVING SUM(sum) >= ALL(SELECT SUM(sum) as Sum
        FROM orders
        GROUP BY client_id)";

        $sql = "SELECT 
              CONCAT(clients.name, ' ', clients.last_name) AS CLIENT, 
              orders.sum, 
              (SELECT order_statuses.name FROM order_statuses WHERE order_statuses.id = orders.status_id) AS status
          FROM clients RIGHT JOIN orders on clients.id = orders.client_id ORDER BY orders.sum DESC";


        $smtp = $pdo->prepare($sql);
        $smtp->execute();

        echo("<pre>");
        print_r($smtp->fetchAll());
        echo("</pre>");

        //dump($smtp->fetchAll());
    }

    public function l1()
    {
        $cat = dir(".");

        dump($cat->path);
        dump($cat->read());
        dump($cat->read());
        dump($cat->read());
        dump($cat->read());

        $cat->rewind();

        dump($cat->read());

        $cat->close();
    }

    public function l2()
    {
        function generator()
        {
            foreach (range(1, 10) as $item) {
                yield $item;
            }
        }

        $data = generator();

        while ($data->valid()) {
            dump($data->current());
            $data->next();
        }
    }

    public function l3()
    {
        //Замыкания можно передать в класс, а внем привязать его к себе, в итоге внутри замыкания $this будет работать с объектом класса
    }

    public function l4()
    {
        //dump(\IntlChar::chr("a"));
    }

    public function l5()
    {
        //dump(date("Y-m-d", strtotime("last day")));

        $date = new \DateTime();
        //dump($date->format("Y-m-d"));

        $date1 = new \DateTime(date("Y-m-d", strtotime("last month")));
        $date2 = new \DateTime(date("Y-m-d", strtotime("last day")));

        $diff = $date2->diff($date1);
        dump($diff);
        dump($diff->format("%Y-%m-%d"));

        $now = new \DateTime();
        $step = new \DateInterval('P1W');
        $period = new \DatePeriod($now, $step, 5);
        foreach($period as $datetime) {
            echo $datetime->format("Y-m-d") . "<br />";
        }
    }

    public function l6()
    {
        $car = new Car("bmw", 7644655, "black", 5);

        foreach ($car as $key => $value) {
            dump($value);
        }
    }

    public function l7()
    {
        $num = $_COOKIE["num"] ?? 0;
        setcookie("num", $num + 1, time() + 100);

        //parse_str() превращает строку сериализованной формы в массив
        // http_build_query() -reverse
        //parse_url()

        dump($num);
        dump(headers_list());
        dump(getallheaders());


        return response("success")
            ->header("Content-Type", 'application/json')
            ->header("Accept", 'application/json');
    }

    public function getOrders(Request $request)
    {
        dump("get Orders");
        //dump($request->headers);

        $guzzleClient = new Client();

        $clients = "999|";
        $clients = $guzzleClient->request("GET", env("API_URL") . "/clients", [
            'contentType' => 'application/json',
            "headers" => [
                "Api-Token" => "slava_token"
            ],
            'json' => []
        ])->getBody()->getContents();


        return $clients . 888;
    }

    public function getClients()
    {
        return "clients response|";
    }

    public function l8()
    {
        dump(gethostbynamel("klavogonki.ru"));

        dump(gethostbyaddr("136.243.77.89"));
    }

}









$f = function () {
    dump($this->apiUrl);
};
$f->bindTo(new NovaPoshta(), NovaPoshta::class);
//$f();

class Car implements \IteratorAggregate
{
    private $name;
    private $price;
    private $color;
    private $age;

    public function __construct($name, $price, $color, $age)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
        $this->age = $age;
    }

    public function getIterator()
    {
        return new CarIterator($this);
    }
}

class CarIterator implements \Iterator
{
    private $obj;

    public function __construct(Car $car)
    {
        $this->obj = $car;
    }

    public function valid()
    {
        return rand(0, 5);
    }

    public function key()
    {

    }

    public function current()
    {
        return rand(10, 100);
    }

    public function next()
    {
        return 7;
    }

    public function rewind()
    {

    }


}