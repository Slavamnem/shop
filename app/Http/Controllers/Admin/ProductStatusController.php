<?php

namespace App\Http\Controllers\Admin;

use App\ProductStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ProductStatusController extends Controller
{
    public function __construct()
    {
        View::share("activeMenu", "product-statuses");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = ProductStatus::all();

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
