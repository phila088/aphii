<?php

namespace App\Policies;

use App\Models\ClientCoverageArea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientCoverageAreaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientCoverageArea $clientCoverageArea): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientCoverageArea $clientCoverageArea): bool
    {
    }

    public function delete(User $user, ClientCoverageArea $clientCoverageArea): bool
    {
    }

    public function restore(User $user, ClientCoverageArea $clientCoverageArea): bool
    {
    }

    public function forceDelete(User $user, ClientCoverageArea $clientCoverageArea): bool
    {
    }
}
