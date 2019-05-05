<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * ModelGroupController constructor.
     * @param Request $request
//     * @param ModelGroupService $service
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        //$this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    public function index()
    {
        return view("access_denied", ["message" => "Доступ только для Сео-специалистов!"]);
        return view("admin.ceo.index");
    }

}