<?php

namespace App\Policies;

use App\Models\Blotter;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlotterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['resident', 'staff', 'admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Blotter $blotter): bool
    {
        // Resident can only view their own blotter
       if ($user->role === 'resident') {
        return $user->resident->resident_id === $blotter->resident_id;
       }

       // Staff and admin can view all the blotters
       return in_array($user->role, ['staff', 'admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // user can only create blotter if they are a resident
        return $user->role === 'resident';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Blotter $blotter): bool
    {
        // only staff can update blotter status
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Blotter $blotter): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Blotter $blotter): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Blotter $blotter): bool
    {
        return false;
    }
}
