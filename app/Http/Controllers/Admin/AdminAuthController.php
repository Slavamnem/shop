<?php

namespace App\Http\Controllers\Admin;

use App\AdminAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class AdminAuthController extends Controller
{
    const MENU_ITEM_NAME = "admin-auth";

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
        $auths = AdminAuth::query()->orderByDesc('created_at')->get();

        return view("admin.admin_auth.index", compact('auths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admin_auth.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = new AdminAuth();

        $auth->fill($request->only($auth->getFillable()));
        $auth->save();

        return redirect()->route("admin-auth-edit", ['id' => $auth->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = AdminAuth::find($id);

        return view("admin.admin_auth.show", compact("auth"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = AdminAuth::find($id);

        return view("admin.admin_auth.edit", compact("auth"));
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
        $auth = AdminAuth::find($id);

        $auth->fill($request->only($auth->getFillable()));

        $auth->save();

        return redirect()->route("admin-auth-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auth = AdminAuth::find($id);
        $auth->delete();

        return redirect()->route("admin-auth");
    }
}
