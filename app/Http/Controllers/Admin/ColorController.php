<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Http\Requests\Admin\CreateColorRequest;
use App\Http\Requests\Admin\EditCategoryRequest;
use App\Http\Requests\Admin\EditColorRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ColorController extends Controller
{
    const MENU_ITEM_NAME = "product-colors";

    /**
     * ProductStatusController constructor.
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
        $colors = Color::query()->paginate(10);

        return view("admin.colors.index", compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.colors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateColorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateColorRequest $request)
    {
        $color = new Color();

        $color->fill($request->only($color->getFillable()));
        $color->save();

        return redirect()->route("admin-colors-edit", ['id' => $color->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $color = Color::find($id);

        return view("admin.colors.show", compact("color"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);

        return view("admin.colors.edit", compact("color"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditColorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditColorRequest $request, $id)
    {
        $color = Color::find($id);

        $color->fill($request->only($color->getFillable()));

        $color->save();

        return redirect()->route("admin-colors-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();

        return redirect()->route("admin-colors");
    }
}
