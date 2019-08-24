<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\SectionsAccess\SeoAccessMiddleware;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CeoController extends Controller
{
    const MENU_ITEM_NAME = "ceo";

    /**
     * @var
     */
    private $service;
    /**
     * @var
     */
    private $request;

    /**
     * CeoController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->middleware([SeoAccessMiddleware::class]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->can('watchSeo', User::class)) {
            return view("admin.ceo.index");
        } else {
            return view("access_denied", ["message" => "Доступ только для Сео-специалистов!"]);
        }
    }
}