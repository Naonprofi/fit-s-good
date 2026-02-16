<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkerSchedule;
use Illuminate\Auth\Access\Response;

class WorkerSchedulePolicy
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
    public function view(User $user, WorkerSchedule $workerSchedule): bool
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
    public function update(User $user, WorkerSchedule $workerSchedule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorkerSchedule $workerSchedule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WorkerSchedule $workerSchedule): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WorkerSchedule $workerSchedule): bool
    {
        return false;
    }

    public function before(User $user, string $ability): ?bool
    {
        if ($user->is_admin) {
            return true; // Az adminnak mindent szabad
        }

        return null; // Ha nem admin, megyünk tovább a konkrét metódusra
    }
}
