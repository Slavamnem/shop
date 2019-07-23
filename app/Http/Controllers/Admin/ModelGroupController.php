<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Http\Requests\Admin\CreateModelGroupRequest;
use App\Http\Requests\Admin\EditModelGroupRequest;
use App\ModelGroup;
use App\Services\Admin\Interfaces\ProductServiceInterface;
use App\Services\Admin\ModelGroupService;
use App\Services\Admin\ProductService;
use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ModelGroupController extends Controller
{
    const MENU_ITEM_NAME = "groups";

    /**
     * @var
     */
    private $service;

    /**
     * @var
     */
    private $request;

    /**
     * ModelGroupController constructor.
     * @param Request $request
     * @param ModelGroupService $service
     */
    public function __construct(Request $request, ModelGroupService $service)
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
        $groups = ModelGroup::query()->paginate(10);

        return view("admin.groups.index", compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.groups.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateModelGroupRequest $request
     * @param  ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function store(CreateModelGroupRequest $request, ProductService $productService)
    {
        $group = new ModelGroup();

        $group->fill($request->only($group->getFillable()));
        $group->save();

        if ($request->has("generator")) {
            $productService->createModifications($group);
        }

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
        $categories = Category::all();

        return view("admin.groups.show", compact("group", "categories"));
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
        $categories = Category::all();

        return view("admin.groups.edit", compact("group", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditModelGroupRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditModelGroupRequest $request, $id)
    {
        $group = ModelGroup::find($id);

        $group->fill($request->only($group->getFillable()));

        $group->save();

        return redirect()->route("admin-groups-edit", ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $group = ModelGroup::find($id);
        $group->delete();

        return redirect()->route("admin-groups");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $groups = $this->service->getFilteredGroups();

        return view("admin.groups.filtered_table", compact('groups'));
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function getModificationsBlock() // TODO
    {
        $data = [
            "colors" => Color::all(),
            "sizes" => Size::all()
        ];

        return view("admin.groups.modifications", $data)->render();
    }
}
