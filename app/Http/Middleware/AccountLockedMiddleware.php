<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountLockedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check) {
            $user = Auth::user();

            if ($user->isLocked()) {
                return redirect()->route('account.locked');
            }
        }
        return $next($request);
    }
}
