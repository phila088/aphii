<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Quote $quote): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Quote $quote): bool
    {
    }

    public function delete(User $user, Quote $quote): bool
    {
    }

    public function restore(User $user, Quote $quote): bool
    {
    }

    public function forceDelete(User $user, Quote $quote): bool
    {
    }
}
