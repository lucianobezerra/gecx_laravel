<?php

namespace Gecx\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Authenticate{
    public function handle($request, Closure $next, $guard = null){
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if(Gate::denies('auth')){
            abort(403);
        }

        return $next($request);
    }
}
