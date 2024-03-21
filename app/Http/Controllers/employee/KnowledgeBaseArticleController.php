<?php

namespace App\Http\Controllers\employee;

use App\Models\KnowledgeBaseArticle;
use Illuminate\Http\Request;

class KnowledgeBaseArticleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', KnowledgeBaseArticle::class);

        return KnowledgeBaseArticle::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', KnowledgeBaseArticle::class);

        $data = $request->validate([

        ]);

        return KnowledgeBaseArticle::create($data);
    }

    public function show(KnowledgeBaseArticle $knowledgeBaseArticle)
    {
        $this->authorize('view', $knowledgeBaseArticle);

        return $knowledgeBaseArticle;
    }

    public function update(Request $request, KnowledgeBaseArticle $knowledgeBaseArticle)
    {
        $this->authorize('update', $knowledgeBaseArticle);

        $data = $request->validate([

        ]);

        $knowledgeBaseArticle->update($data);

        return $knowledgeBaseArticle;
    }

    public function destroy(KnowledgeBaseArticle $knowledgeBaseArticle)
    {
        $this->authorize('delete', $knowledgeBaseArticle);

        $knowledgeBaseArticle->delete();

        return response()->json();
    }
}
