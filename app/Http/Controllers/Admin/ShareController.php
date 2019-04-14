<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\ModelGroup;
use App\Product;
use App\ProductStatus;
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
     * @param Request $request
     * ProductController constructor.
     * param ProductServiceInterface $service
     */
    public function __construct(Request $request)//ProductServiceInterface $service)
    {
        //$this->service = $service;
        $this->request = $request;
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
        //
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

    public function addNewCondition()
    {
        $conditions = (new Product())->getTranslatedFields();
        $operations = ["=", "!=", "<", "<=", ">", ">=", "LIKE"];
        $type = $this->request->type;

        return view("admin.shares.new-condition", compact('conditions', 'operations', 'type'))->render();
    }

    public function addNewConditionValues()
    {
        $valuesHub = [
            "category_id" => Category::all()->map(function($category){ return $category->name; }),
            "group_id"    => ModelGroup::all()->map(function($group){ return $group->name; }),
            "status_id"   => ProductStatus::all()->map(function($status){ return $status->name; }),
            "color_id"    => Color::all()->map(function($color){ return $color->name; }),
            "size_id"     => Size::all()->map(function($size){ return $size->name; }),
        ];

        $values = @$valuesHub[$this->request->field];
        //$values = Category::all()->map(function($category){ return $category->name; });

        return $values ? view("admin.shares.new-condition-values", compact('values'))->render() : "";
    }
}
