<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Brand $brand): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Brand $brand): bool
    {
    }

    public function delete(User $user, Brand $brand): bool
    {
    }

    public function restore(User $user, Brand $brand): bool
    {
    }

    public function forceDelete(User $user, Brand $brand): bool
    {
    }
}
