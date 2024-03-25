<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class UserController
{
    public function index(): View
    {
        return view('admin.users.index');
    }
}
