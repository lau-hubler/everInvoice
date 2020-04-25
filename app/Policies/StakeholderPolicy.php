<?php

namespace App\Policies;

use App\Stakeholder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StakeholderPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any stakeholders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role->hasPermission('stakeholder.index');
    }

    /**
     * Determine whether the user can view the stakeholder.
     *
     * @param  \App\User  $user
     * @param  \App\Stakeholder  $stakeholder
     * @return mixed
     */
    public function view(User $user, Stakeholder $stakeholder)
    {
        return $user->role->hasPermission('stakeholder.show');
    }

    /**
     * Determine whether the user can create stakeholders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role->hasPermission('stakeholder.store');
    }

    /**
     * Determine whether the user can update the stakeholder.
     *
     * @param  \App\User  $user
     * @param  \App\Stakeholder  $stakeholder
     * @return mixed
     */
    public function update(User $user, Stakeholder $stakeholder)
    {
        return $user->role->hasPermission('stakeholder.update');
    }

    /**
     * Determine whether the user can delete the stakeholder.
     *
     * @param  \App\User  $user
     * @param  \App\Stakeholder  $stakeholder
     * @return mixed
     */
    public function delete(User $user, Stakeholder $stakeholder)
    {
        return $user->role->hasPermission('stakeholder.delete');
    }

    /**
     * Determine whether the user can restore the stakeholder.
     *
     * @param  \App\User  $user
     * @param  \App\Stakeholder  $stakeholder
     * @return mixed
     */
    public function restore(User $user, Stakeholder $stakeholder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the stakeholder.
     *
     * @param  \App\User  $user
     * @param  \App\Stakeholder  $stakeholder
     * @return mixed
     */
    public function forceDelete(User $user, Stakeholder $stakeholder)
    {
        //
    }
}
