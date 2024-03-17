<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderVendorClock;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderVendorClockPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderVendorClock $workOrderVendorClock): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderVendorClock $workOrderVendorClock): bool
    {
    }

    public function delete(User $user, WorkOrderVendorClock $workOrderVendorClock): bool
    {
    }

    public function restore(User $user, WorkOrderVendorClock $workOrderVendorClock): bool
    {
    }

    public function forceDelete(User $user, WorkOrderVendorClock $workOrderVendorClock): bool
    {
    }
}
