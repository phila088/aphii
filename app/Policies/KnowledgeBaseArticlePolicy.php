<?php

namespace App\Policies;

use App\Models\KnowledgeBaseArticle;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgeBaseArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, KnowledgeBaseArticle $knowledgeBaseArticle): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, KnowledgeBaseArticle $knowledgeBaseArticle): bool
    {
    }

    public function delete(User $user, KnowledgeBaseArticle $knowledgeBaseArticle): bool
    {
    }

    public function restore(User $user, KnowledgeBaseArticle $knowledgeBaseArticle): bool
    {
    }

    public function forceDelete(User $user, KnowledgeBaseArticle $knowledgeBaseArticle): bool
    {
    }
}
