<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VendorCoverageArea;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorCoverageAreaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, VendorCoverageArea $vendorCoverageArea): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, VendorCoverageArea $vendorCoverageArea): bool
    {
    }

    public function delete(User $user, VendorCoverageArea $vendorCoverageArea): bool
    {
    }

    public function restore(User $user, VendorCoverageArea $vendorCoverageArea): bool
    {
    }

    public function forceDelete(User $user, VendorCoverageArea $vendorCoverageArea): bool
    {
    }
}
