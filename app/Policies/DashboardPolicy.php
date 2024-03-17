<?php

namespace App\Policies;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Dashboard $dashboard): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Dashboard $dashboard): bool
    {
    }

    public function delete(User $user, Dashboard $dashboard): bool
    {
    }

    public function restore(User $user, Dashboard $dashboard): bool
    {
    }

    public function forceDelete(User $user, Dashboard $dashboard): bool
    {
    }
}
