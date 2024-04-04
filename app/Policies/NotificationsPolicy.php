<?php

namespace App\Policies;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Notifications $notifications): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Notifications $notifications): bool
    {
    }

    public function delete(User $user, Notifications $notifications): bool
    {
    }

    public function restore(User $user, Notifications $notifications): bool
    {
    }

    public function forceDelete(User $user, Notifications $notifications): bool
    {
    }
}
