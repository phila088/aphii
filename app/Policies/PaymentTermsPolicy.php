<?php

namespace App\Policies;

use App\Models\PaymentTerm;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentTermsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, PaymentTerm $paymentTerms): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PaymentTerm $paymentTerms): bool
    {
    }

    public function delete(User $user, PaymentTerm $paymentTerms): bool
    {
    }

    public function restore(User $user, PaymentTerm $paymentTerms): bool
    {
    }

    public function forceDelete(User $user, PaymentTerm $paymentTerms): bool
    {
    }
}
