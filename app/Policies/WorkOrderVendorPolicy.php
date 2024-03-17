<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderVendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderVendorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderVendor $workOrderVendor): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderVendor $workOrderVendor): bool
    {
    }

    public function delete(User $user, WorkOrderVendor $workOrderVendor): bool
    {
    }

    public function restore(User $user, WorkOrderVendor $workOrderVendor): bool
    {
    }

    public function forceDelete(User $user, WorkOrderVendor $workOrderVendor): bool
    {
    }
}
