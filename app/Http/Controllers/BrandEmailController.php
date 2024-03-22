<?php

namespace App\Http\Controllers;

use App\Models\BrandEmail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandEmailController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandEmail::class);

        return BrandEmail::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandEmail::class);

        $data = $request->validate([

        ]);

        return BrandEmail::create($data);
    }

    public function show(BrandEmail $brandEmail)
    {
        $this->authorize('view', $brandEmail);

        return $brandEmail;
    }

    public function update(Request $request, BrandEmail $brandEmail)
    {
        $this->authorize('update', $brandEmail);

        $data = $request->validate([

        ]);

        $brandEmail->update($data);

        return $brandEmail;
    }

    public function destroy(BrandEmail $brandEmail)
    {
        $this->authorize('delete', $brandEmail);

        $brandEmail->delete();

        return response()->json();
    }
}
