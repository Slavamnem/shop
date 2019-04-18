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
        $this->service->saveConditions($share);
        //dd($request->all());
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addNewCondition(ProductServiceInterface $productService)
    {
        $operations = ["=", "!=", "<", "<=", ">", ">=", "LIKE"];
        $conditions = $productService->getConditionsFields();
        $type = $this->request->type;
        $typeTranslation = $type == "or" ? "ИЛИ" : "И";
        $conditionId = $this->request->conditionId;

        return view("admin.shares.new-condition", compact('conditions', 'operations', 'type', 'typeTranslation', 'conditionId'))->render();
    }

    public function addNewConditionValues()
    {
        $valuesHub = [
            "id"          => Product::all()->mapWithKeys(function($product){
                return [$product->id => $product->name . " (id: {$product->id})"];
            }),
            "category_id" => Category::all()->mapWithKeys(function($category){
                return [$category->id => $category->name];
            }),
            "group_id"    => ModelGroup::all()->mapWithKeys(function($group){
                return [$group->id => $group->name];
            }),
            "status_id"   => ProductStatus::all()->mapWithKeys(function($status){
                return [$status->id => $status->name];
            }),
            "color_id"    => Color::all()->mapWithKeys(function($color){
                return [$color->id => $color->name];
            }),
            "size_id"     => Size::all()->mapWithKeys(function($size){
                return [$size->id => $size->name];
            }),
        ];

        $values = [];
        if (isset($valuesHub[$this->request->field])) {
            $values = $valuesHub[$this->request->field];
        }


        return view("admin.shares.new-condition-values", compact('values'))->render();
    }
}
