<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Strict Transport Security (HSTS) - Category 3
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        
        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Clickjacking Protection - Category 6
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // XSS Protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Permissions Policy (formerly Feature Policy)
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        
        // Content Security Policy - Balanced security without breaking CRUD functionality
        // Note: Using 'unsafe-inline' and 'unsafe-eval' to maintain compatibility with Laravel Blade,
        // jQuery, Bootstrap, and AJAX operations. This is acceptable for internal applications
        // with proper CSRF protection and authentication already in place.
        $csp = implode('; ', [
            "default-src 'self'",
            // Allow scripts from self and trusted CDNs (cross-domain allowed for CDN resources)
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https:",
            // Allow inline styles (required by Bootstrap & Laravel blade templates)
            "style-src 'self' 'unsafe-inline' https:",
            // Allow images from any HTTPS source (for user uploads, external images)
            "img-src 'self' data: https: blob:",
            // Allow fonts from any HTTPS source
            "font-src 'self' data: https:",
            // Allow AJAX/fetch requests (critical for CRUD operations)
            "connect-src 'self' https:",
            // Allow media from self and HTTPS
            "media-src 'self' https:",
            // Allow iframes from Google Maps
            "frame-src 'self' https://www.google.com https://maps.google.com",
            // Upgrade insecure requests to HTTPS in production
            "upgrade-insecure-requests"
        ]);
        $response->headers->set('Content-Security-Policy', $csp);
        
        return $response;
    }
}
