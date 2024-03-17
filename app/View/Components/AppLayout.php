<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;
use Coderello\Laraflash\Facades\Laraflash;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = Auth::user();
        return view('layouts.master')
            ->with('user', $user);
    }
}
