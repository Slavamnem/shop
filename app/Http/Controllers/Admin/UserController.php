<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Role;
use App\Services\Admin\Interfaces\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    const MENU_ITEM_NAME = "users";

    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserServiceInterface
     */
    private $service;

    /**
     * UserController constructor.
     * @param Request $request
     * @param UserServiceInterface $service
     */
    public function __construct(Request $request, UserServiceInterface $service)
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
        $users = User::query()->paginate(10);

        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->request->user()->can("create", User::class)) {
            $roles = Role::all();
            return view("admin.users.create", compact('roles'));
        } else {
            return view('admin.info.403', ['message' => "В доступе отказано\nПользователей могут добавлять только администраторы"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User();

        $user->fill($request->only($user->getFillable()));
        $user->password = Hash::make($user->password);
        $user->save();
        $this->service->saveRoles($user);

        return redirect()->route("admin-users-edit", ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('roles')->where('id', $id)->first();

        return view("admin.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        $roles = Role::all();

        return view("admin.users.edit", compact("user", 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if ($this->request->user()->can("update", User::class)) {
            $user = User::find($id);

            $oldPassword = $user->password;
            $user->fill($request->only($user->getFillable()));
            if ($user->password != $oldPassword) {
                $user->password = Hash::make($user->password);
            }

            $this->service->saveRoles($user);
            $user->save();

            return redirect()->route("admin-users-edit", ['id' => $id]);
        } else {
            return view('admin.info.403', ['message' => "В доступе отказано\nПользователей могут редактировать только администраторы"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->request->user()->can("delete", User::class)) {
            $user = User::find($id);
            $user->delete();

            return redirect()->route("admin-users");
        } else {
            return view('admin.info.403', ['message' => "В доступе отказано\nПользователей могут удалять только администраторы"]);
        }
    }
}
