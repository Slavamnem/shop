<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryType;
use App\Http\Requests\Admin\CreateDeliveryTypeRequest;
use App\Http\Requests\Admin\UpdateDeliveryTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DeliveryTypeController extends Controller
{
    const MENU_ITEM_NAME = "delivery-type";

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
        $deliveryTypes = DeliveryType::query()->paginate(10);

        return view("admin.delivery_type.index", compact('deliveryTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.delivery_type.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDeliveryTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDeliveryTypeRequest $request)
    {
        $deliveryType = new DeliveryType();

        $deliveryType->fill($request->only($deliveryType->getFillable()));
        $deliveryType->save();

        return redirect()->route("admin-delivery-type-edit", ['id' => $deliveryType->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliveryType = DeliveryType::find($id);

        return view("admin.delivery_type.show", compact("deliveryType"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deliveryType = DeliveryType::find($id);

        return view("admin.delivery_type.edit", compact("deliveryType"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDeliveryTypeRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryTypeRequest $request, $id)
    {
        $deliveryType = DeliveryType::find($id);

        $deliveryType->fill($request->only($deliveryType->getFillable()));

        $deliveryType->save();

        return redirect()->route("admin-delivery-type-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliveryType = DeliveryType::find($id);
        $deliveryType->delete();

        return redirect()->route("admin-delivery-type");
    }
}
