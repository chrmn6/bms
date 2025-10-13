<?php

namespace App\Policies;

use App\Models\Clearance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClearancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['resident', 'admin', 'staff']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Clearance $clearance): bool
    {
        if ($user->role === 'resident') {
            // Resident can only view their own clearance
            return $clearance->resident_id === $user->resident->resident_id;
        }

        // Staff and admin can view all clearances
        return in_array($user->role, ['staff', 'admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'resident';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Clearance $clearance): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Clearance $clearance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Clearance $clearance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Clearance $clearance): bool
    {
        return false;
    }
}
