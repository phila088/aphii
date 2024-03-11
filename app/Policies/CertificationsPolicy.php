<?php

namespace App\Policies;

use App\Models\Certifications;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertificationsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Certifications $certifications): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Certifications $certifications): bool
    {
    }

    public function delete(User $user, Certifications $certifications): bool
    {
    }

    public function restore(User $user, Certifications $certifications): bool
    {
    }

    public function forceDelete(User $user, Certifications $certifications): bool
    {
    }
}
