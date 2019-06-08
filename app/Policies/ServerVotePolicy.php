<?php

namespace App\Policies;

use App\User;
use App\ServerVote;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServerVotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any server votes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the server vote.
     *
     * @param  \App\User  $user
     * @param  \App\ServerVote  $serverVote
     * @return mixed
     */
    public function view(User $user, ServerVote $serverVote)
    {
        //
    }

    /**
     * Determine whether the user can create server votes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(?User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the server vote.
     *
     * @param  \App\User  $user
     * @param  \App\ServerVote  $serverVote
     * @return mixed
     */
    public function update(User $user, ServerVote $serverVote)
    {
        //
    }

    /**
     * Determine whether the user can delete the server vote.
     *
     * @param  \App\User  $user
     * @param  \App\ServerVote  $serverVote
     * @return mixed
     */
    public function delete(User $user, ServerVote $serverVote)
    {
        //
    }

    /**
     * Determine whether the user can restore the server vote.
     *
     * @param  \App\User  $user
     * @param  \App\ServerVote  $serverVote
     * @return mixed
     */
    public function restore(User $user, ServerVote $serverVote)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the server vote.
     *
     * @param  \App\User  $user
     * @param  \App\ServerVote  $serverVote
     * @return mixed
     */
    public function forceDelete(User $user, ServerVote $serverVote)
    {
        //
    }
}
