<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocumentCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentCategoryController
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('documentCategories.viewAll');

        return view('admin.document-categories.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return DocumentCategory::create($data);
    }

    public function show(DocumentCategory $documentCategory)
    {
        return $documentCategory;
    }

    public function update(Request $request, DocumentCategory $documentCategory)
    {
        $data = $request->validate([

        ]);

        $documentCategory->update($data);

        return $documentCategory;
    }

    public function destroy(DocumentCategory $documentCategory)
    {
        $documentCategory->delete();

        return response()->json();
    }
}
