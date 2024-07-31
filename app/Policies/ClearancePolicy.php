<?php

namespace App\Policies;

use App\Models\Clearance;
use App\Models\User;

class ClearancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Clearance $clearance): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Clearance $clearance): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Clearance $clearance): bool
    {
        return in_array($user->role_id, [1, 2]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Clearance $clearance): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Clearance $clearance): bool
    {
        //
    }
}
