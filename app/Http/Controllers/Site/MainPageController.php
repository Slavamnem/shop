<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Components\SecurityCenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dump(App::make(SecurityCenter::class)->checkUserIp());

        $categories = Category::query()->whereNull('pid')->get();
        //$categories = Category::query()->get();
        return view('index', compact('categories'));
    }
}
