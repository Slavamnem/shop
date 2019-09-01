<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Http\Requests\Admin\CreateColorRequest;
use App\Http\Requests\Admin\CreateSiteElementRequest;
use App\Http\Requests\Admin\EditCategoryRequest;
use App\Http\Requests\Admin\EditColorRequest;
use App\Http\Requests\Admin\UpdateSiteElementRequest;
use App\Services\Admin\Interfaces\SiteElementsServiceInterface;
use App\SiteElement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class SiteElementController extends Controller
{
    const MENU_ITEM_NAME = "site-elements";

    /**
     * @var SiteElementsServiceInterface
     */
    private $service;

    /**
     * SiteElementController constructor.
     * @param SiteElementsServiceInterface $service
     */
    public function __construct(SiteElementsServiceInterface $service)
    {
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteElements = SiteElement::query()->paginate(10);

        return view("admin.site_elements.index", compact('siteElements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.site_elements.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSiteElementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSiteElementRequest $request)
    {
        $siteElement = new SiteElement();

        $siteElement->fill($request->only($siteElement->getFillable()));

        if ($request->input('type') == 'text') {
            $siteElement->value = $request->input('value');
        }
        if ($request->input('type') == 'image') {
            if ($img = $request->value) {
                $siteElement->value = $img->getClientOriginalName();
                Storage::putFileAs("", $img, $siteElement->value);
            }
        }

        $siteElement->save();

        return redirect()->route("admin-site-elements-edit", ['id' => $siteElement->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siteElement = SiteElement::find($id);

        return view("admin.site_elements.show", compact("siteElement"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siteElement = SiteElement::find($id);

        return view("admin.site_elements.edit", compact("siteElement"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSiteElementRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteElementRequest $request, $id)
    {
        $siteElement = SiteElement::find($id);

        $siteElement->fill($request->only($siteElement->getFillable()));

        if ($request->input('type') == 'text') {
            $siteElement->value = $request->input('value');
        }
        if ($request->input('type') == 'image') {
            if ($img = $request->value) {
                $siteElement->value = $img->getClientOriginalName();
                Storage::putFileAs("", $img, $siteElement->value);
            }
        }

        $siteElement->save();

        return redirect()->route("admin-site-elements-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siteElement = SiteElement::find($id);
        $siteElement->delete();

        return redirect()->route("admin-site-elements");
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function getValueBlock(Request $request)
    {
        $type = $request->input('type');
        $siteElement = SiteElement::query()->where('key', $request->input('key'))->first();
        return view("admin.site_elements.value_block", compact('type', 'siteElement'))->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        $siteElements = $this->service->getFilteredElements();

        return view("admin.site_elements.filtered_table", compact('siteElements'));
    }
}
