<?php

namespace App\Policies;

use App\Models\Counties;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountiesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Counties $counties): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Counties $counties): bool
    {
    }

    public function delete(User $user, Counties $counties): bool
    {
    }

    public function restore(User $user, Counties $counties): bool
    {
    }

    public function forceDelete(User $user, Counties $counties): bool
    {
    }
}
