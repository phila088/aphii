<?php

namespace App\Policies;

use App\Models\BrandProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandProfilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandProfile $brandProfile): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandProfile $brandProfile): bool
    {
    }

    public function delete(User $user, BrandProfile $brandProfile): bool
    {
    }

    public function restore(User $user, BrandProfile $brandProfile): bool
    {
    }

    public function forceDelete(User $user, BrandProfile $brandProfile): bool
    {
    }
}
