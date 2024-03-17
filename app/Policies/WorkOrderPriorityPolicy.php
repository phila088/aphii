<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderPriority;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderPriorityPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderPriority $workOrderPriority): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderPriority $workOrderPriority): bool
    {
    }

    public function delete(User $user, WorkOrderPriority $workOrderPriority): bool
    {
    }

    public function restore(User $user, WorkOrderPriority $workOrderPriority): bool
    {
    }

    public function forceDelete(User $user, WorkOrderPriority $workOrderPriority): bool
    {
    }
}
