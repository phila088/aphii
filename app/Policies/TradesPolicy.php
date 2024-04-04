<?php

namespace App\Policies;

use App\Models\Trades;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TradesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Trades $trades): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Trades $trades): bool
    {
    }

    public function delete(User $user, Trades $trades): bool
    {
    }

    public function restore(User $user, Trades $trades): bool
    {
    }

    public function forceDelete(User $user, Trades $trades): bool
    {
    }
}
