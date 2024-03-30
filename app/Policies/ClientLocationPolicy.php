<?php

namespace App\Policies;

use App\Models\ClientLocation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientLocationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientLocation $clientLocation): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientLocation $clientLocation): bool
    {
    }

    public function delete(User $user, ClientLocation $clientLocation): bool
    {
    }

    public function restore(User $user, ClientLocation $clientLocation): bool
    {
    }

    public function forceDelete(User $user, ClientLocation $clientLocation): bool
    {
    }
}
