<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderScheduleAttempt;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderScheduleAttemptPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderScheduleAttempt $workOrderScheduleAttempt): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderScheduleAttempt $workOrderScheduleAttempt): bool
    {
    }

    public function delete(User $user, WorkOrderScheduleAttempt $workOrderScheduleAttempt): bool
    {
    }

    public function restore(User $user, WorkOrderScheduleAttempt $workOrderScheduleAttempt): bool
    {
    }

    public function forceDelete(User $user, WorkOrderScheduleAttempt $workOrderScheduleAttempt): bool
    {
    }
}
