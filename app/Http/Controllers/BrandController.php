<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        return view('brands.index');
    }

    public function view(): View
    {
        return view('brands.view');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Brand::class);

        $data = $request->validate([

        ]);

        return Brand::create($data);
    }

    public function show(Brand $brand)
    {
        $this->authorize('view', $brand);

        return $brand;
    }

    public function update(Request $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        $data = $request->validate([

        ]);

        $brand->update($data);

        return $brand;
    }

    public function destroy(Brand $brand)
    {
        $this->authorize('delete', $brand);

        $brand->delete();

        return response()->json();
    }
}
