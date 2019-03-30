<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\ModelGroup;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\ProductService;
use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ModelGroupController extends Controller
{
    public function __construct()
    {
        View::share("activeMenu", "groups");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = ModelGroup::all();

        return view("admin.groups.index", compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.groups.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductService $productService)
    {
        //dd($request->all());
        $group = new ModelGroup();

        $group->fill($request->only($group->getFillable()));
        $group->save();

        //
        if ($request->has("generator")) {
            $productService->createModifications($request, $group->id);
            //dd("has");
        }
        //dd("has not");
        //

        return redirect()->route("admin-groups-edit", ['id' => $group->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = ModelGroup::find($id);

        return view("admin.groups.show", compact("group"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = ModelGroup::find($id);

        return view("admin.groups.edit", compact("group"));
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
        $group = ModelGroup::find($id);

        $group->fill($request->only($group->getFillable()));

        $group->save();

        return redirect()->route("admin-groups-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = ModelGroup::find($id);
        $group->delete();

        return redirect()->route("admin-groups");
    }

    //
    public function getModificationsBlock()
    {
        $data = [
            "colors" => Color::all(),
            "sizes" => Size::all()
        ];

        return view("admin.groups.modifications", $data)->render();
    }
}
