<?php

namespace App\Http\Controllers\Employee;

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

    public function ap(): View
    {
        return view('dashboards.ap', []);
    }

    public function ar(): View
    {
        return view('dashboards.ar', []);
    }

    public function quoting(): View
    {
        return view('dashboards.quoting', []);
    }

    public function sales(): View
    {
        return view('dashboards.sales', []);
    }

    public function workOrders(): View
    {
        return view('dashboards.work-orders', []);
    }


}
