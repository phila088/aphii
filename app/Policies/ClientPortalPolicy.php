<?php

namespace App\Policies;

use App\Models\ClientPortal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPortalPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientPortal $clientPortal): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientPortal $clientPortal): bool
    {
    }

    public function delete(User $user, ClientPortal $clientPortal): bool
    {
    }

    public function restore(User $user, ClientPortal $clientPortal): bool
    {
    }

    public function forceDelete(User $user, ClientPortal $clientPortal): bool
    {
    }
}
