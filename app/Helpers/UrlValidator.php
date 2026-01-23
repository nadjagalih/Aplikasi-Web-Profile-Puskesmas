<?php

namespace App\Helpers;

class UrlValidator
{
    /**
     * Validate if a URL is safe for redirection.
     * Prevents open redirect vulnerabilities.
     *
     * @param string $url
     * @param array $allowedHosts Optional array of allowed external hosts
     * @return bool
     */
    public static function isSafeRedirectUrl($url, array $allowedHosts = [])
    {
        if (empty($url)) {
            return false;
        }

        // Allow relative URLs (starting with /)
        if (strpos($url, '/') === 0 && strpos($url, '//') !== 0) {
            return true;
        }

        // Parse the URL
        $parsedUrl = parse_url($url);

        // If URL parsing failed, reject it
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $urlHost = strtolower($parsedUrl['host']);

        // Get current application host from config
        $appHost = strtolower(parse_url(config('app.url'), PHP_URL_HOST));

        // Allow same-host redirects
        if ($urlHost === $appHost) {
            return true;
        }

        // Allow common localhost variations
        $localhostVariations = ['localhost', '127.0.0.1', '::1'];
        if (in_array($urlHost, $localhostVariations) && in_array($appHost, $localhostVariations)) {
            return true;
        }

        // Get current request host as fallback
        if (isset($_SERVER['HTTP_HOST'])) {
            $requestHost = strtolower(parse_url('http://' . $_SERVER['HTTP_HOST'], PHP_URL_HOST));
            if ($urlHost === $requestHost) {
                return true;
            }
        }

        // Check if host is in allowed list
        if (!empty($allowedHosts) && in_array($urlHost, $allowedHosts)) {
            return true;
        }

        // Reject external URLs by default
        return false;
    }

    /**
     * Sanitize redirect URL or return default.
     *
     * @param string|null $url
     * @param string $default Default URL if validation fails
     * @param array $allowedHosts Optional array of allowed external hosts
     * @return string
     */
    public static function sanitizeRedirectUrl($url, $default = '/', array $allowedHosts = [])
    {
        if (empty($url)) {
            return $default;
        }

        return self::isSafeRedirectUrl($url, $allowedHosts) ? $url : $default;
    }

    /**
     * Validate if a URL belongs to the current application.
     *
     * @param string $url
     * @return bool
     */
    public static function isInternalUrl($url)
    {
        if (empty($url)) {
            return false;
        }

        // Relative URLs are internal
        if (strpos($url, '/') === 0 && strpos($url, '//') !== 0) {
            return true;
        }

        // Parse and compare hosts
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $appHost = parse_url(config('app.url'), PHP_URL_HOST);
        return $parsedUrl['host'] === $appHost;
    }
}
