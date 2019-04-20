<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\Interfaces\ShareServiceInterface;
use App\Share;
use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ShareController extends Controller
{
    const MENU_ITEM_NAME = "shares";

    /**
     * @var
     */
    private $service;

    /**
     * @var
     */
    private $request;

    /**
     * ShareController constructor.
     * @param Request $request
     * @param ShareServiceInterface $service
     */
    public function __construct(Request $request, ShareServiceInterface $service)
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
        $shares = Share::all();

        return view("admin.shares.index", compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.shares.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $share = new Share();

        $share->fill($request->only($share->getFillable()));
        $this->service->setConditions($share); //dd($request->all());
        $share->save();

        return redirect()->route("admin-shares-edit", ['id' => $share->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  ProductServiceInterface $productService
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductServiceInterface $productService, $id)
    {
        $share = Share::find($id);
        //$data = $this->service->getNewConditionData();
        //dump($share->conditions);
        $conditionsData = [];
        foreach ($share->conditions as $num => $condition) {
            array_push($conditionsData, [
                "conditions"         => $productService->getConditionsFields(),
                "operations"         => $this->service->getConditionsOperations(),
                "delimiterType"      => array_keys($condition)[0],
                "delimiterTypeTrans" => array_keys($condition)[0] == "or" ? "ИЛИ" : "И",
                "conditionId"        => $num,
                "conditionsAmount"   => $num,
                "currentCondition"   => $condition[array_keys($condition)[0]]["field"],
                "currentOperation"   => $condition[array_keys($condition)[0]]["operation"],
                "currentValues"      => $this->service->getConditionValues($condition[array_keys($condition)[0]]["field"]),
                "currentValue"       => $condition[array_keys($condition)[0]]["value"],
            ]);

        }

        return view("admin.shares.edit", compact("share", "conditionsData"));
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
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $share = Share::find($id);
        $share->delete();

        return redirect()->route("admin-shares");
    }

    public function addNewCondition()
    {
        $data = $this->service->getNewConditionData();

        return view("admin.shares.condition", $data)->render();
    }

    public function loadConditionValues()
    {
        $values = $this->service->getConditionValues($this->request->field);

        return view("admin.shares.condition-values", compact('values'))->render();
    }
}
