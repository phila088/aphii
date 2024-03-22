<?php

namespace App\Policies;

use App\Models\CallFollowups;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CallFollowupsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CallFollowups $callFollowups): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CallFollowups $callFollowups): bool
    {
    }

    public function delete(User $user, CallFollowups $callFollowups): bool
    {
    }

    public function restore(User $user, CallFollowups $callFollowups): bool
    {
    }

    public function forceDelete(User $user, CallFollowups $callFollowups): bool
    {
    }
}
