<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreatePaymentTypeRequest;
use App\Http\Requests\Admin\UpdatePaymentTypeRequest;
use App\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class PaymentTypeController extends Controller
{
    const MENU_ITEM_NAME = "payment-type";

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
        $paymentTypes = PaymentType::query()->paginate(10);

        return view("admin.payment_type.index", compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.payment_type.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePaymentTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentTypeRequest $request)
    {
        $paymentType = new PaymentType();

        $paymentType->fill($request->only($paymentType->getFillable()));
        $paymentType->save();

        return redirect()->route("admin-payment-type-edit", ['id' => $paymentType->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentType = PaymentType::find($id);

        return view("admin.payment_type.show", compact("paymentType"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentType = PaymentType::find($id);

        return view("admin.payment_type.edit", compact("paymentType"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentTypeRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentTypeRequest $request, $id)
    {
        $paymentType = PaymentType::find($id);

        $paymentType->fill($request->only($paymentType->getFillable()));

        $paymentType->save();

        return redirect()->route("admin-payment-type-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentType = PaymentType::find($id);
        $paymentType->delete();

        return redirect()->route("admin-payment-type");
    }
}
