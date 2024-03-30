<?php

namespace App\Policies;

use App\Models\PotentialClientContacts;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PotentialClientContactsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, PotentialClientContacts $potentialClientContacts): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PotentialClientContacts $potentialClientContacts): bool
    {
    }

    public function delete(User $user, PotentialClientContacts $potentialClientContacts): bool
    {
    }

    public function restore(User $user, PotentialClientContacts $potentialClientContacts): bool
    {
    }

    public function forceDelete(User $user, PotentialClientContacts $potentialClientContacts): bool
    {
    }
}
