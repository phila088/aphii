<?php

namespace App\Policies;

use App\Models\BrandHour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandHoursPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandHour $brandHours): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandHour $brandHours): bool
    {
    }

    public function delete(User $user, BrandHour $brandHours): bool
    {
    }

    public function restore(User $user, BrandHour $brandHours): bool
    {
    }

    public function forceDelete(User $user, BrandHour $brandHours): bool
    {
    }
}
