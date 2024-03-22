<?php

namespace App\Http\Controllers\Employee;

use Illuminate\View\View;

class DocumentCategoriesController extends Controller
{
    public function index(): View
    {
        return view('admin.documents.categories', []);
    }
}
