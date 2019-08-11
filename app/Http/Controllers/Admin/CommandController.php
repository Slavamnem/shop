<?php

namespace App\Http\Controllers\Admin;

use App\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CommandController extends Controller
{
    const MENU_ITEM_NAME = "commands";

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
//     * @param ModelGroupService $service
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        //$this->service = $service;
        View::share("activeMenuItem", self::MENU_ITEM_NAME);
    }

    public function index()
    {
        return view("admin.commands.index");
    }

    public function search()
    {
        $searchString = trim(explode("--", $this->request->input('value'))[0]);

        $commands = Command::query()
            ->where('name', 'like', "%{$searchString}%")
            ->orWhere('code', 'like', "%{$searchString}%")
            ->get();

        return view("admin.commands.filtered_commands", compact('commands'));
    }

    public function execute()
    {
        $commandSignature = trim(explode("--", $this->request->input('commandCode'))[0]);

        preg_match_all("|(--[^=\s]*)=(\S*)|", $this->request->input('commandCode'), $matches);
        $options = [];
        foreach ($matches[0] as $id => $match) {
            $options[$matches[1][$id]] = $matches[2][$id];
        }

        Session::forget('commandResponse');
        Artisan::call($commandSignature, $options);

        return [
            Session::get('commandResponse'),
            Session::get('commandViewType'),
        ];
        //return "---" . $this->request->input('commandCode');
    }
}