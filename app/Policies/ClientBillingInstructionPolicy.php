<?php

namespace App\Policies;

use App\Models\ClientBillingInstruction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientBillingInstructionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ClientBillingInstruction $clientBillingInstruction): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ClientBillingInstruction $clientBillingInstruction): bool
    {
    }

    public function delete(User $user, ClientBillingInstruction $clientBillingInstruction): bool
    {
    }

    public function restore(User $user, ClientBillingInstruction $clientBillingInstruction): bool
    {
    }

    public function forceDelete(User $user, ClientBillingInstruction $clientBillingInstruction): bool
    {
    }
}
