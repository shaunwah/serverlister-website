<?php

namespace App\Policies;

use App\User;
use App\Server;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any servers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the server.
     *
     * @param  \App\User  $user
     * @param  \App\Server  $server
     * @return mixed
     */
    public function view(User $user, Server $server)
    {
        //
    }

    /**
     * Determine whether the user can create servers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the server.
     *
     * @param  \App\User  $user
     * @param  \App\Server  $server
     * @return mixed
     */
    public function update(User $user, Server $server)
    {
        return $user->id == $server->user_id || $user->id == 1;
    }

    /**
     * Determine whether the user can delete the server.
     *
     * @param  \App\User  $user
     * @param  \App\Server  $server
     * @return mixed
     */
    public function delete(User $user, Server $server)
    {
        return $user->id == $server->user_id;
    }

    /**
     * Determine whether the user can restore the server.
     *
     * @param  \App\User  $user
     * @param  \App\Server  $server
     * @return mixed
     */
    public function restore(User $user, Server $server)
    {
        return $user->id == $server->user_id;
    }

    /**
     * Determine whether the user can permanently delete the server.
     *
     * @param  \App\User  $user
     * @param  \App\Server  $server
     * @return mixed
     */
    public function forceDelete(User $user, Server $server)
    {
        return $user->id == $server->user_id;
    }
}
