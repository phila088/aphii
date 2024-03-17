<?php

namespace App\Policies;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMethodPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, PaymentMethod $paymentMethod): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PaymentMethod $paymentMethod): bool
    {
    }

    public function delete(User $user, PaymentMethod $paymentMethod): bool
    {
    }

    public function restore(User $user, PaymentMethod $paymentMethod): bool
    {
    }

    public function forceDelete(User $user, PaymentMethod $paymentMethod): bool
    {
    }
}
