<?php

namespace App\Policies;

use App\Models\States;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, States $states): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, States $states): bool
    {
    }

    public function delete(User $user, States $states): bool
    {
    }

    public function restore(User $user, States $states): bool
    {
    }

    public function forceDelete(User $user, States $states): bool
    {
    }
}
