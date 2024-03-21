<?php

namespace App\Http\Controllers\employee;

use App\Models\Certifications;
use Illuminate\Http\Request;

class CertificationsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Certifications::class);

        return Certifications::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Certifications::class);

        $data = $request->validate([

        ]);

        return Certifications::create($data);
    }

    public function show(Certifications $certifications)
    {
        $this->authorize('view', $certifications);

        return $certifications;
    }

    public function update(Request $request, Certifications $certifications)
    {
        $this->authorize('update', $certifications);

        $data = $request->validate([

        ]);

        $certifications->update($data);

        return $certifications;
    }

    public function destroy(Certifications $certifications)
    {
        $this->authorize('delete', $certifications);

        $certifications->delete();

        return response()->json();
    }
}
