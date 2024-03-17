<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrderVendorPayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderVendorPaymentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, WorkOrderVendorPayment $workOrderVendorPayment): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, WorkOrderVendorPayment $workOrderVendorPayment): bool
    {
    }

    public function delete(User $user, WorkOrderVendorPayment $workOrderVendorPayment): bool
    {
    }

    public function restore(User $user, WorkOrderVendorPayment $workOrderVendorPayment): bool
    {
    }

    public function forceDelete(User $user, WorkOrderVendorPayment $workOrderVendorPayment): bool
    {
    }
}
