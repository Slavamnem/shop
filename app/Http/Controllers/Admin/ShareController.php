<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Components\Facades\Conditions;
use App\Http\Requests\Admin\CreateShareRequest;
use App\Http\Requests\Admin\EditShareRequest;
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
        $shares = Share::query()->paginate(10);

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
     * @param  CreateShareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShareRequest $request)
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
        $share = Share::find($id);
        $conditionsBox = Conditions::getExistingConditions($share);

        return view("admin.shares.show", compact("share", "conditionsBox"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $share = Share::find($id);
        //$conditionsData = $this->service->getOldConditionsData($share);
        $conditionsBox = Conditions::getExistingConditions($share);

        return view("admin.shares.edit", compact("share", "conditionsBox"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditShareRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditShareRequest $request, $id)
    {
        $share = Share::find($id);

        $share->fill($request->only($share->getFillable()));
        $this->service->setConditions($share);
        $share->save();

        return redirect()->route("admin-shares-edit", ['id' => $share->id]);
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $shares = $this->service->getFilteredShares();

        return view("admin.shares.filtered_table", compact('shares'));
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function addNewCondition()
    {
        $conditionsBox = Conditions::getNewConditionBox($this->request);
        $data = [
            'conditionsList' => $conditionsBox->getConditionsList(),
            'operationsList' => $conditionsBox->getOperationsList(),
            'delimiter'      => $conditionsBox->getDelimiter(),
            'delimiterTrans' => $conditionsBox->getDelimiterTrans(),
            'condition'      => $conditionsBox->getCondition($this->request->conditionId)
        ];

        return view("admin.shares.condition", $data)->render();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function loadConditionValues()
    {
        $values = Conditions::getValuesList($this->request->field);

        return view("admin.shares.condition-values", compact('values'))->render();
    }
}
