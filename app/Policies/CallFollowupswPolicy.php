<?php

namespace App\Policies;

use App\Models\CallFollowupsw;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CallFollowupswPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CallFollowupsw $callFollowupsw): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CallFollowupsw $callFollowupsw): bool
    {
    }

    public function delete(User $user, CallFollowupsw $callFollowupsw): bool
    {
    }

    public function restore(User $user, CallFollowupsw $callFollowupsw): bool
    {
    }

    public function forceDelete(User $user, CallFollowupsw $callFollowupsw): bool
    {
    }
}
