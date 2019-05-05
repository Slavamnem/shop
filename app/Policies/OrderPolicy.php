<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function watch(User $user, Order $order)
    {
        return $user->hasRole("superadmin") or $user->hasRole("admin");
    }

}
