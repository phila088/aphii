<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VendorContact;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, VendorContact $vendorContact): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, VendorContact $vendorContact): bool
    {
    }

    public function delete(User $user, VendorContact $vendorContact): bool
    {
    }

    public function restore(User $user, VendorContact $vendorContact): bool
    {
    }

    public function forceDelete(User $user, VendorContact $vendorContact): bool
    {
    }
}
