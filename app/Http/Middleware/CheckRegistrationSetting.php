<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRegistrationSetting
{
    public function handle(Request $request, Closure $next)
    {
        // check if registration is allowed
        if (!config('app.allow_registration', false)) {
            // if not redirect user
            return redirect('/');
        }

        // if allowed, continue
        return $next($request);
    }
}
