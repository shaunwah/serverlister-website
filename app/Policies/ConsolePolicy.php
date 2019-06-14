<?php

namespace App\Policies;

use App\User;
use App\Console;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConsolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any consoles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the console.
     *
     * @param  \App\User  $user
     * @param  \App\Console  $console
     * @return mixed
     */
    public function view(User $user, Console $console)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can create consoles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the console.
     *
     * @param  \App\User  $user
     * @param  \App\Console  $console
     * @return mixed
     */
    public function update(User $user, Console $console)
    {
        //
    }

    /**
     * Determine whether the user can delete the console.
     *
     * @param  \App\User  $user
     * @param  \App\Console  $console
     * @return mixed
     */
    public function delete(User $user, Console $console)
    {
        //
    }

    /**
     * Determine whether the user can restore the console.
     *
     * @param  \App\User  $user
     * @param  \App\Console  $console
     * @return mixed
     */
    public function restore(User $user, Console $console)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the console.
     *
     * @param  \App\User  $user
     * @param  \App\Console  $console
     * @return mixed
     */
    public function forceDelete(User $user, Console $console)
    {
        //
    }
}
