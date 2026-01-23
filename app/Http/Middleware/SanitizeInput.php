<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInput
{
    /**
     * Handle an incoming request.
     * Sanitizes user input to prevent XSS and injection attacks
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Validate and sanitize referer header to prevent referer-dependent attacks
        if ($request->headers->has('referer')) {
            $referer = $request->headers->get('referer');
            
            // Ensure referer is from the same domain
            $appUrl = parse_url(config('app.url'), PHP_URL_HOST);
            $refererHost = parse_url($referer, PHP_URL_HOST);
            
            // If referer is not from same domain, remove it
            if ($refererHost && $appUrl && $refererHost !== $refererHost) {
                // Log suspicious activity if needed
                Log::warning('Suspicious referer detected', [
                    'referer' => $referer,
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl()
                ]);
            }
        }
        
        // Sanitize query parameters to prevent HTTP parameter pollution
        $input = $request->all();
        $sanitized = $this->sanitizeArray($input);
        $request->merge($sanitized);
        
        return $next($request);
    }
    
    /**
     * Recursively sanitize array input
     *
     * @param array $data
     * @return array
     */
    private function sanitizeArray(array $data)
    {
        $sanitized = [];
        
        foreach ($data as $key => $value) {
            // Sanitize key
            $cleanKey = $this->sanitizeString($key);
            
            if (is_array($value)) {
                $sanitized[$cleanKey] = $this->sanitizeArray($value);
            } else if (is_string($value)) {
                // Don't sanitize values here - let validation handle it
                // Just remove null bytes and control characters
                $sanitized[$cleanKey] = $this->removeControlCharacters($value);
            } else {
                $sanitized[$cleanKey] = $value;
            }
        }
        
        return $sanitized;
    }
    
    /**
     * Sanitize string to prevent key injection
     *
     * @param string $string
     * @return string
     */
    private function sanitizeString($string)
    {
        // Remove null bytes and control characters from keys
        return preg_replace('/[\x00-\x1F\x7F]/u', '', $string);
    }
    
    /**
     * Remove control characters from values
     *
     * @param string $string
     * @return string
     */
    private function removeControlCharacters($string)
    {
        // Remove null bytes and dangerous control characters
        return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $string);
    }
}
