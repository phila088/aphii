<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrder $workOrder): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrder $workOrder): bool
    {
    }

    public function delete(User $user, WorkOrder $workOrder): bool
    {
    }

    public function restore(User $user, WorkOrder $workOrder): bool
    {
    }

    public function forceDelete(User $user, WorkOrder $workOrder): bool
    {
    }
}
