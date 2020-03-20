<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccount
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && get_class($request->user()) == 'App\Account') {
            return $next($request);
        }

        return redirect()->route('accounts.home');
    }
}
