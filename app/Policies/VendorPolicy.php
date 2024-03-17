<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Vendor $vendor): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Vendor $vendor): bool
    {
    }

    public function delete(User $user, Vendor $vendor): bool
    {
    }

    public function restore(User $user, Vendor $vendor): bool
    {
    }

    public function forceDelete(User $user, Vendor $vendor): bool
    {
    }
}
