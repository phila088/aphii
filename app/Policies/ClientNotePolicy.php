<?php

namespace App\Policies;

use App\Models\ClientNote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientNotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientNote $clientNote): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientNote $clientNote): bool
    {
    }

    public function delete(User $user, ClientNote $clientNote): bool
    {
    }

    public function restore(User $user, ClientNote $clientNote): bool
    {
    }

    public function forceDelete(User $user, ClientNote $clientNote): bool
    {
    }
}
