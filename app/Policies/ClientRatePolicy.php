<?php

namespace App\Policies;

use App\Models\ClientRate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientRatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientRate $clientRate): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientRate $clientRate): bool
    {
    }

    public function delete(User $user, ClientRate $clientRate): bool
    {
    }

    public function restore(User $user, ClientRate $clientRate): bool
    {
    }

    public function forceDelete(User $user, ClientRate $clientRate): bool
    {
    }
}
