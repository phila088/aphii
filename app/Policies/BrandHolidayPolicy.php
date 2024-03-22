<?php

namespace App\Policies;

use App\Models\BrandHoliday;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandHolidayPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandHoliday $brandHoliday): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandHoliday $brandHoliday): bool
    {
    }

    public function delete(User $user, BrandHoliday $brandHoliday): bool
    {
    }

    public function restore(User $user, BrandHoliday $brandHoliday): bool
    {
    }

    public function forceDelete(User $user, BrandHoliday $brandHoliday): bool
    {
    }
}
