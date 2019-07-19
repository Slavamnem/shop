<?php

namespace App\Services\Admin;

use App\Client;
use App\Services\Admin\Interfaces\ClientServiceInterface;
use App\Services\Admin\Interfaces\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    /**
     * @var
     */
    private $request;

    /**
     * ClientService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param User $user
     */
    public function saveRoles(User $user)
    {
        $roles = collect();
        foreach ($this->request->input('roles') as $roleId) {
            $roles->put($roleId, ['setter_id' => Auth::id()]);
        }

        $user->roles()->sync($roles->toArray());
    }
}
