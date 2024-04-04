<?php

namespace App\Policies;

use App\Models\BrandVendor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandVendorsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandVendor $brandVendors): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandVendor $brandVendors): bool
    {
    }

    public function delete(User $user, BrandVendor $brandVendors): bool
    {
    }

    public function restore(User $user, BrandVendor $brandVendors): bool
    {
    }

    public function forceDelete(User $user, BrandVendor $brandVendors): bool
    {
    }
}
