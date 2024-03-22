<?php

namespace App\Http\Controllers\Employee;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Quote::class);

        return Quote::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Quote::class);

        $data = $request->validate([

        ]);

        return Quote::create($data);
    }

    public function show(Quote $quote)
    {
        $this->authorize('view', $quote);

        return $quote;
    }

    public function update(Request $request, Quote $quote)
    {
        $this->authorize('update', $quote);

        $data = $request->validate([

        ]);

        $quote->update($data);

        return $quote;
    }

    public function destroy(Quote $quote)
    {
        $this->authorize('delete', $quote);

        $quote->delete();

        return response()->json();
    }
}
