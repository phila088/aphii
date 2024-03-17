<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderNote;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderNotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderNote $workOrderNote): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderNote $workOrderNote): bool
    {
    }

    public function delete(User $user, WorkOrderNote $workOrderNote): bool
    {
    }

    public function restore(User $user, WorkOrderNote $workOrderNote): bool
    {
    }

    public function forceDelete(User $user, WorkOrderNote $workOrderNote): bool
    {
    }
}
