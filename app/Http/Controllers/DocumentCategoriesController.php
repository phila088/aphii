<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\DocumentCategory;

class DocumentCategoriesController extends Controller
{
    public function index(): View
    {
        return view('admin.documents.categories', []);
    }
}
