<?php

namespace App\Policies;

use App\Models\ContactTitle;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactTitlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any contact titles.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {

    }

    /**
     * Determine whether the user can view the contact title.
     *
     * @param User $user
     * @param ContactTitle $contactTitle
     * @return bool
     */
    public function view(User $user, ContactTitle $contactTitle): bool
    {
    }

    /**
     * Determine whether the user can create contact titles.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
    }

    /**
     * Determine whether the user can update the contact title.
     *
     * @param User $user
     * @param ContactTitle $contactTitle
     * @return bool
     */
    public function update(User $user, ContactTitle $contactTitle): bool
    {
    }

    /**
     * Determine whether the user can delete the contact title.
     *
     * @param User $user
     * @param ContactTitle $contactTitle
     * @return bool
     */
    public function delete(User $user, ContactTitle $contactTitle): bool
    {
    }

    /**
     * Determine whether the user can restore the contact title.
     *
     * @param User $user
     * @param ContactTitle $contactTitle
     * @return bool
     */
    public function restore(User $user, ContactTitle $contactTitle): bool
    {
    }

    /**
     * Determine whether the user can permanently delete the contact title.
     *
     * @param User $user
     * @param ContactTitle $contactTitle
     * @return bool
     */
    public function forceDelete(User $user, ContactTitle $contactTitle): bool
    {
    }
}
