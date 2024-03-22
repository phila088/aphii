<?php

namespace App\Policies;

use App\Models\BrandAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandAddressPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandAddress $brandAddress): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandAddress $brandAddress): bool
    {
    }

    public function delete(User $user, BrandAddress $brandAddress): bool
    {
    }

    public function restore(User $user, BrandAddress $brandAddress): bool
    {
    }

    public function forceDelete(User $user, BrandAddress $brandAddress): bool
    {
    }
}
