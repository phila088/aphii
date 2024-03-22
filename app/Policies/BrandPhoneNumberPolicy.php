<?php

namespace App\Policies;

use App\Models\BrandPhoneNumber;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPhoneNumberPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, BrandPhoneNumber $brandPhoneNumber): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, BrandPhoneNumber $brandPhoneNumber): bool
    {
    }

    public function delete(User $user, BrandPhoneNumber $brandPhoneNumber): bool
    {
    }

    public function restore(User $user, BrandPhoneNumber $brandPhoneNumber): bool
    {
    }

    public function forceDelete(User $user, BrandPhoneNumber $brandPhoneNumber): bool
    {
    }
}
