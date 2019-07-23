<?php

namespace App\Http\Controllers\Admin;

use App\ProductStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ProductStatusController extends Controller
{
    const MENU_ITEM_NAME = "product-statuses";

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
        $statuses = ProductStatus::query()->paginate(10);

        return view("admin.product-statuses.index", compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.product-statuses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = new ProductStatus();

        $status->fill($request->only($status->getFillable()));
        $status->save();

        return redirect()->route("admin-product-statuses-edit", ['id' => $status->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = ProductStatus::find($id);

        return view("admin.product-statuses.show", compact("status"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = ProductStatus::find($id);

        return view("admin.product-statuses.edit", compact("status"));
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
        $status = ProductStatus::find($id);

        $status->fill($request->only($status->getFillable()));

        $status->save();

        return redirect()->route("admin-product-statuses-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = ProductStatus::find($id);
        $status->delete();

        return redirect()->route("admin-product-statuses");
    }
}
