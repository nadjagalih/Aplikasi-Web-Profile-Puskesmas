<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use App\Helpers\UrlValidator;

class ValidateRedirect
{
    /**
     * Handle an incoming request.
     * Prevents open redirect vulnerabilities by validating redirect URLs.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if this is a redirect response
        if ($response->isRedirect()) {
            $targetUrl = $response->headers->get('Location');

            // Validate the redirect URL
            if (!UrlValidator::isSafeRedirectUrl($targetUrl)) {
                // Log suspicious redirect attempt
                Log::warning('Blocked potentially malicious redirect', [
                    'target_url' => $targetUrl,
                    'request_url' => $request->fullUrl(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);

                // Redirect to safe location instead
                return redirect('/');
            }
        }

        // Also check common redirect parameters in GET/POST
        $redirectParams = ['redirect', 'return', 'next', 'url', 'continue', 'redirect_url', 'return_url'];
        
        foreach ($redirectParams as $param) {
            if ($request->has($param)) {
                $url = $request->input($param);
                
                if (!empty($url) && !UrlValidator::isSafeRedirectUrl($url)) {
                    // Log suspicious parameter
                    Log::warning('Blocked potentially malicious redirect parameter', [
                        'parameter' => $param,
                        'value' => $url,
                        'request_url' => $request->fullUrl(),
                        'ip' => $request->ip(),
                    ]);

                    // Remove dangerous parameter
                    $request->merge([$param => '/']);
                }
            }
        }

        return $response;
    }
}
