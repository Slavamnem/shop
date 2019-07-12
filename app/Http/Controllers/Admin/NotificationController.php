<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class NotificationController extends Controller
{
    const MENU_ITEM_NAME = "notifications";

    /**
     * @var
     */
    private $service;

    /**
     * @var
     */
    private $request;

    /**
     * NotificationController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
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
        $notifications = Notification::all();

        return view("admin.notifications.index", compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.notifications.create");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $notification = new Notification();

        $notification->fill($request->only($notification->getFillable()));
        $notification->save();

        return redirect()->route("admin-notifications-edit", ['id' => $notification->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        $notification->status = "close";
        $notification->save();

        return view("admin.notifications.show", compact( "notification"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notification::find($id);

        return view("admin.notifications.edit", compact("notification"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);

        $notification->fill($request->only($notification->getFillable()));

        $notification->save();

        return redirect()->route("admin-notifications-edit", ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return redirect()->route("admin-notifications");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter()
    {
        //$notifications = $this->service->getFilteredGroups();

        //return view("admin.notifications.filtered_table", compact('notifications'));
    }

}