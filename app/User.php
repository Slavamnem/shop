<?php

namespace App;

use App\Console\Commands\Executors\Executor;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'login', 'email', 'password', 'api_token', 'last_enter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, "user_roles");//, "role_id", "user_id");
    }

    /**
     * @param $roles
     * @return mixed
     */
    public function hasRole($roles)
    {
        return $this->roles->contains(function($role) use($roles){ return in_array($role->name, $roles); });
    }

    /**
     * @return Executor
     */
    public function createExecutor()
    {
        return new Executor(
            $this->hasRole(['developer']),
            $this->hasRole(['admin']),
            $this->hasRole(['moderator']),
            $this->hasRole(['ceo'])
        );
    }
}
