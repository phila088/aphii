<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class StatusCodeController
{
    public function index(): View
    {
        return view('admin.status-codes.index');
    }
}
