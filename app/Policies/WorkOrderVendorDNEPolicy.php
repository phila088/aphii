<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderVendorDNE;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderVendorDNEPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderVendorDNE $workOrderVendorDNE): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderVendorDNE $workOrderVendorDNE): bool
    {
    }

    public function delete(User $user, WorkOrderVendorDNE $workOrderVendorDNE): bool
    {
    }

    public function restore(User $user, WorkOrderVendorDNE $workOrderVendorDNE): bool
    {
    }

    public function forceDelete(User $user, WorkOrderVendorDNE $workOrderVendorDNE): bool
    {
    }
}
