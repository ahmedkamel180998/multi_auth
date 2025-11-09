<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (! auth()->guard('admin')->user()->hasAnyPermission($permission)) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
