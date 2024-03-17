<?php

namespace App\Policies;

use App\Models\ContactDepartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactDepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ContactDepartment $contactDepartment): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ContactDepartment $contactDepartment): bool
    {
    }

    public function delete(User $user, ContactDepartment $contactDepartment): bool
    {
    }

    public function restore(User $user, ContactDepartment $contactDepartment): bool
    {
    }

    public function forceDelete(User $user, ContactDepartment $contactDepartment): bool
    {
    }
}
