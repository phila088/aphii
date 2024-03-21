<?php

namespace App\Http\Controllers\employee;

use Illuminate\View\View;

class DocumentCategoriesController extends Controller
{
    public function index(): View
    {
        return view('admin.documents.categories', []);
    }
}
