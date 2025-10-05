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
       if ($user->role === 'resident') {
        return $user->resident->resident_id === $blotter->resident_id;
       }

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
    public function update(User $user, Blotter $blotter): bool
    {
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
