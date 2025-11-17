<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only enforce HTTPS in production or when FORCE_HTTPS is explicitly enabled
        if (env('FORCE_HTTPS', false) && !$request->secure() && env('APP_ENV') !== 'local') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
