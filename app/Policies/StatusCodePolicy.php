<?php

namespace App\Policies;

use App\Models\StatusCode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusCodePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, StatusCode $statusCode): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, StatusCode $statusCode): bool
    {
    }

    public function delete(User $user, StatusCode $statusCode): bool
    {
    }

    public function restore(User $user, StatusCode $statusCode): bool
    {
    }

    public function forceDelete(User $user, StatusCode $statusCode): bool
    {
    }
}
