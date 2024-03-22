<?php

namespace App\Policies;

use App\Models\brand_address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class brand_addressPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, brand_address $brand_address): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, brand_address $brand_address): bool
    {
    }

    public function delete(User $user, brand_address $brand_address): bool
    {
    }

    public function restore(User $user, brand_address $brand_address): bool
    {
    }

    public function forceDelete(User $user, brand_address $brand_address): bool
    {
    }
}
