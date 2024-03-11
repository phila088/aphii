<?php

namespace App\Policies;

use App\Models\DocumentCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, DocumentCategory $documentCategory): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, DocumentCategory $documentCategory): bool
    {
    }

    public function delete(User $user, DocumentCategory $documentCategory): bool
    {
    }

    public function restore(User $user, DocumentCategory $documentCategory): bool
    {
    }

    public function forceDelete(User $user, DocumentCategory $documentCategory): bool
    {
    }
}
