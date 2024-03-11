<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardsController extends Controller
{
    public function index()
    {
        return view('pages.dashboards.index');
    }

    public function dashboard(): View
    {
        return view('pages.dashboards.index');
    }

    public function personal(): View
    {
        return view('dashboards.personal', []);
    }



}
