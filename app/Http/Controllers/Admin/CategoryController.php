<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    const MENU_ITEM_NAME = "categories";

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("admin.categories.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $category = Category::find($id);

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
        $category = Category::find($id);

        return view("admin.categories.edit", compact("category"));
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
        $category = Category::find($id);

        $category->fill($request->only($category->getFillable()));

        $category->save();

        return redirect()->route("admin-categories-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Category::find($id);
        $product->delete();

        return redirect()->route("admin-categories");
    }
}
