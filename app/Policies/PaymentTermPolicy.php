<?php

namespace App\Policies;

use App\Models\PaymentTerm;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentTermPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, PaymentTerm $paymentTerm): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PaymentTerm $paymentTerm): bool
    {
    }

    public function delete(User $user, PaymentTerm $paymentTerm): bool
    {
    }

    public function restore(User $user, PaymentTerm $paymentTerm): bool
    {
    }

    public function forceDelete(User $user, PaymentTerm $paymentTerm): bool
    {
    }
}
