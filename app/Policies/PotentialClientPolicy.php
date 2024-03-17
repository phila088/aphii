<?php

namespace App\Policies;

use App\Models\PotentialClient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PotentialClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, PotentialClient $potentialClient): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PotentialClient $potentialClient): bool
    {
    }

    public function delete(User $user, PotentialClient $potentialClient): bool
    {
    }

    public function restore(User $user, PotentialClient $potentialClient): bool
    {
    }

    public function forceDelete(User $user, PotentialClient $potentialClient): bool
    {
    }
}
