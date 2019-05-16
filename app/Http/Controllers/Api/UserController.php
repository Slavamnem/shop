<?php

namespace App\Http\Controllers\Api;

use App\Components\Helpers\ResponseHelper;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getUsers()
    {
        $data = UserResource::collection(User::all());

        return ResponseHelper::success($data);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(User $user)
    {
        $data = new UserResource($user);

        return ResponseHelper::success($data);
    }
}
