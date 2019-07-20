<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole(['superadmin', 'admin', 'developer']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasRole(['superadmin', 'admin', 'developer']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasRole(['superadmin', 'admin', 'developer']);
    }
}
