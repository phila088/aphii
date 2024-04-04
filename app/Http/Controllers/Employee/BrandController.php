<?php

namespace App\Http\Controllers\Employee;

use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    public function index(): View
    {
        return view('employee.brands.index');
    }

    public function create(): View
    {
        $this->authorize('brands.create', Brand::class);

        return view('employee.brands.create');
    }

    public function view($id): RedirectResponse|View
    {
        try {
            $brand = Brand::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $this->authorize('brands.viewany', Brand::class);

            return redirect()->route('employee.brands.index');
        }
        $this->authorize('brands.viewone', Brand::class);

        return view('employee.brands.view', ['brand' => $brand]);
    }

    public function edit($id)
    {
        $this->authorize('brands.edit', Brand::class);

        try {
            $brand = Brand::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $this->authorize('brands.viewany', Brand::class);

            return redirect()->route('employee.brands.index');
        }
        $this->authorize('brands.edit', Brand::class);

        return view('employee.brands.edit', ['brand' => $brand]);
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
