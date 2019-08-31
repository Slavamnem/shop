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

    /**
     * @param User $user
     * @return mixed
     */
    public function watchCommands(User $user)
    {
        return $user->hasRole(['developer']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchStat(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchCategories(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator']);
    }
    /**
     * @param User $user
     * @return mixed
     */
    public function watchProducts(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator', 'operator']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchModels(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchShares(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchSeo(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'seo']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchNotifications(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchOrders(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'order-manager', 'operator']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchClients(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator', 'operator', 'order-manager']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchStock(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator', 'operator', 'order-manager']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchAuth(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchDeliveryTypes(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator', 'operator', 'order-manager']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchPaymentTypes(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin', 'moderator', 'operator', 'order-manager']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchUsers(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchRoles(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin']);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function watchSiteElements(User $user)
    {
        return $user->hasRole(['developer', 'superadmin', 'admin']);
    }
}
