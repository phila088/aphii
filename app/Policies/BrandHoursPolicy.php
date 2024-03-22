<?php

namespace App\Policies;

use App\Models\BrandHours;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandHoursPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandHours $brandHours): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandHours $brandHours): bool
    {
    }

    public function delete(User $user, BrandHours $brandHours): bool
    {
    }

    public function restore(User $user, BrandHours $brandHours): bool
    {
    }

    public function forceDelete(User $user, BrandHours $brandHours): bool
    {
    }
}
