<?php

namespace App\Services\Admin\Interfaces;

use App\User;

interface UserServiceInterface
{
    /**
     * @param User $user
     */
    public function saveRoles(User $user);
}
