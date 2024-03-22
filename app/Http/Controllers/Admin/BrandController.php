<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Employee\Controller;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        return view('admin.brands.index');
    }

    public function create(): View{
        return view('admin.brands.create');
    }

    public function view(int $id): View
    {
        return view('admin.brands.view', compact('id'));
    }

    public function edit($id): View
    {
        return view('admin.brands.edit', compact('id'));
    }

    public function delete($id): View
    {
        return view('admin.brands.delete', compact('id'));
    }

    public function destroy($id): View
    {
        return view('admin.brands.destroy', compact('id'));
    }
}
