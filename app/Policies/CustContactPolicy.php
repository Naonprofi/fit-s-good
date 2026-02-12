<?php

namespace App\Policies;

use App\Models\CustContact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustContactPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CustContact $custContact): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CustContact $custContact): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CustContact $custContact): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CustContact $custContact): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CustContact $custContact): bool
    {
        return false;
    }

    public function before(User $user): bool|null
    {
        if ($user->id === 11) {
            return true;
        }
        return null;
    }
}
