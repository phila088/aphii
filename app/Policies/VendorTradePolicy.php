<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VendorTrade;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorTradePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, VendorTrade $vendorTrade): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, VendorTrade $vendorTrade): bool
    {
    }

    public function delete(User $user, VendorTrade $vendorTrade): bool
    {
    }

    public function restore(User $user, VendorTrade $vendorTrade): bool
    {
    }

    public function forceDelete(User $user, VendorTrade $vendorTrade): bool
    {
    }
}
