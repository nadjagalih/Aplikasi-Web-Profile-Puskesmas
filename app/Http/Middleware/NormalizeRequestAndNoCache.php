<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class NormalizeRequestAndNoCache
{
    /**
     * Handle an incoming request.
     * - strip common tracking query params (utm_*, gclid, fbclid, etc.) from the request query
     * - set safe Cache-Control headers for HTML and error responses
     */
    public function handle(Request $request, Closure $next)
    {
        // strip tracking params from query so rendered pages won't reflect them
        $query = $request->query();

        $stripPatterns = [
            '/^utm_/i',
            '/^gclid$/i',
            '/^fbclid$/i',
            '/^mcid$/i',
            '/^ref$/i',
        ];

        $toRemove = [];
        foreach ($query as $k => $v) {
            foreach ($stripPatterns as $pat) {
                if (preg_match($pat, $k)) {
                    $toRemove[] = $k;
                    break;
                }
            }
        }

        if (!empty($toRemove)) {
            // remove from the Symfony GET bag
            foreach ($toRemove as $k) {
                $request->query->remove($k);
            }
        }

        $response = $next($request);

        // ensure responses that are HTML or have status >= 400 are not cached publicly
        $this->applySafeCacheHeaders($response);

        return $response;
    }

    protected function applySafeCacheHeaders($response)
    {
        // unify Response types
        if ($response instanceof SymfonyResponse || method_exists($response, 'headers')) {
            $status = method_exists($response, 'getStatusCode') ? $response->getStatusCode() : ($response->status ?? 200);

            $contentType = '';
            if (method_exists($response, 'headers')) {
                $contentType = $response->headers->get('Content-Type') ?? '';
            }

            $isHtml = Str::contains(strtolower($contentType), 'text/html') || $contentType === '';

            if ($status >= 400 || $isHtml) {
                $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, private');
                $response->headers->set('Pragma', 'no-cache');
                $response->headers->set('Expires', '0');
            }
        }
    }
}
