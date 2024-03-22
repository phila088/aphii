<?php

namespace App\Policies;

use App\Models\BrandEmail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandEmailPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandEmail $brandEmail): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandEmail $brandEmail): bool
    {
    }

    public function delete(User $user, BrandEmail $brandEmail): bool
    {
    }

    public function restore(User $user, BrandEmail $brandEmail): bool
    {
    }

    public function forceDelete(User $user, BrandEmail $brandEmail): bool
    {
    }
}
