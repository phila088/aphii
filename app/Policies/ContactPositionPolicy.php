<?php

namespace App\Policies;

use App\Models\ContactPosition;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPositionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ContactPosition $contactPosition): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ContactPosition $contactPosition): bool
    {
    }

    public function delete(User $user, ContactPosition $contactPosition): bool
    {
    }

    public function restore(User $user, ContactPosition $contactPosition): bool
    {
    }

    public function forceDelete(User $user, ContactPosition $contactPosition): bool
    {
    }
}
