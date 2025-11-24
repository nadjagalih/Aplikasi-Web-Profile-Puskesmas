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
        
        // Prevent cache poisoning attacks - MEDIUM SEVERITY FIX
        // These headers prevent caching of sensitive responses
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, private');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        
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
        
        // Content Security Policy - Enhanced security configuration
        // Protects against XSS, clickjacking, and other code injection attacks
        // All libraries and fonts are now LOCAL (no external CDN dependencies)
        $csp = implode('; ', [
            "default-src 'self'",
            // Scripts: Only self and Google Maps (unsafe-inline for inline scripts, unsafe-eval for some libraries)
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google.com https://maps.google.com",
            // Styles: Self only (unsafe-inline for inline styles)
            "style-src 'self' 'unsafe-inline'",
            // Images: Self, data URIs, HTTPS, Gravatar, placeholders, Wikipedia
            "img-src 'self' data: https: blob: https://www.gravatar.com https://via.placeholder.com https://upload.wikimedia.org",
            // Fonts: Self and data URIs only
            "font-src 'self' data:",
            // AJAX: Self and HTTPS
            "connect-src 'self' https:",
            // Media: Self and HTTPS
            "media-src 'self' https:",
            // Iframes: Self and Google services
            "frame-src 'self' https://www.google.com https://maps.google.com",
            // Prevent base tag hijacking
            "base-uri 'self'",
            // Upgrade insecure requests to HTTPS
            "upgrade-insecure-requests"
        ]);
        $response->headers->set('Content-Security-Policy', $csp);
        
        return $response;
    }
}
