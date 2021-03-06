<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Middleware\SectionsAccess\CategoriesAccessMiddleware;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\EditCategoryRequest;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    const MENU_ITEM_NAME = "categories";

    /**
     * @var Request
     */
    private $request;
    /**
     * @var
     */
    private $service;

    /**
     * CategoryController constructor.
     * @param Request $request
     * @param CategoryService $service
     */
    public function __construct(Request $request, CategoryService $service)
    {
        $this->request = $request;
        $this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->middleware([CategoriesAccessMiddleware::class]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->paginate(10);

        return view("admin.categories.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create", $this->service->getData());
    }

    /**
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();

        $category->fill($request->only($category->getFillable()));
        $category->save();

        return redirect()->route("admin-categories-edit", ['id' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('parent')->find($id);

        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.categories.edit", $this->service->getData($id));
    }

    /**
     * @param EditCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditCategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $category->fill($request->only($category->getFillable()));
        $category->save();

        return redirect()->route("admin-categories-edit", ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Category::find($id);
        $product->delete();

        return redirect()->route("admin-categories");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $categories = $this->service->getFilteredCategories();

        return view("admin.categories.filtered_table", compact('categories'));
    }
}
