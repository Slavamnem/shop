<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateColorRequest;
use App\Http\Requests\Admin\CreateSizeRequest;
use App\Http\Requests\Admin\EditColorRequest;
use App\Http\Requests\Admin\EditSizeRequest;
use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class SizeController extends Controller
{
    const MENU_ITEM_NAME = "product-sizes";

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
        $sizes = Size::query()->paginate(10);

        return view("admin.sizes.index", compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.sizes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSizeRequest $request)
    {
        $size = new Size();

        $size->fill($request->only($size->getFillable()));
        $size->save();

        return redirect()->route("admin-sizes-edit", ['id' => $size->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::find($id);

        return view("admin.sizes.show", compact("size"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);

        return view("admin.sizes.edit", compact("size"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditSizeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSizeRequest $request, $id)
    {
        $size = Size::find($id);

        $size->fill($request->only($size->getFillable()));

        $size->save();

        return redirect()->route("admin-sizes-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        $size->delete();

        return redirect()->route("admin-sizes");
    }
}
