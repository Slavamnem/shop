<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Middleware\SectionsAccess\CategoriesAccessMiddleware;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\EditCategoryRequest;
use App\Services\Admin\CategoryService;
use App\Services\Admin\Interfaces\NewYorkTimesServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class NewYorkTimesController extends Controller
{
    const MENU_ITEM_NAME = "NewYorkTimes";

    /**
     * @var Request
     */
    private $request;
    /**
     * @var NewYorkTimesServiceInterface
     */
    private $service;

    /**
     * CategoryController constructor.
     * @param Request $request
     * @param NewYorkTimesServiceInterface $service
     */
    public function __construct(Request $request, NewYorkTimesServiceInterface $service)
    {
        $this->request = $request;
        $this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.new_york_times.index", ['news' => $this->service->getLastNews(), 'reviews' => $this->service->getLastReviews()]);
    }
}
