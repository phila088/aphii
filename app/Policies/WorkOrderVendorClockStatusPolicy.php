<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderVendorClockStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderVendorClockStatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderVendorClockStatus $workOrderVendorClockStatus): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderVendorClockStatus $workOrderVendorClockStatus): bool
    {
    }

    public function delete(User $user, WorkOrderVendorClockStatus $workOrderVendorClockStatus): bool
    {
    }

    public function restore(User $user, WorkOrderVendorClockStatus $workOrderVendorClockStatus): bool
    {
    }

    public function forceDelete(User $user, WorkOrderVendorClockStatus $workOrderVendorClockStatus): bool
    {
    }
}
