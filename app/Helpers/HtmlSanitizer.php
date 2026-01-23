<?php

namespace App\Helpers;

class HtmlSanitizer
{
    /**
     * Sanitize HTML content from CKEditor to prevent XSS attacks
     * 
     * @param string|null $html
     * @return string|null
     */
    public static function sanitize(?string $html): ?string
    {
        if (empty($html)) {
            return $html;
        }

        // List of allowed HTML tags (safe for CKEditor content)
        $allowedTags = [
            'p', 'br', 'strong', 'em', 'u', 's', 'strike', 'del', 'ins',
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
            'ul', 'ol', 'li',
            'a', 'img',
            'table', 'thead', 'tbody', 'tr', 'th', 'td',
            'blockquote', 'pre', 'code',
            'div', 'span',
            'sup', 'sub',
            'figure', 'figcaption',
        ];

        // List of allowed attributes for specific tags
        $allowedAttributes = [
            'a' => ['href', 'title', 'target', 'rel'],
            'img' => ['src', 'alt', 'title', 'width', 'height', 'style'],
            'table' => ['border', 'cellpadding', 'cellspacing', 'style'],
            'td' => ['colspan', 'rowspan', 'style'],
            'th' => ['colspan', 'rowspan', 'style'],
            'div' => ['style', 'class'],
            'span' => ['style', 'class'],
            'p' => ['style', 'class'],
            'h1' => ['style', 'class'],
            'h2' => ['style', 'class'],
            'h3' => ['style', 'class'],
            'h4' => ['style', 'class'],
            'h5' => ['style', 'class'],
            'h6' => ['style', 'class'],
        ];

        // Remove dangerous tags and attributes
        $html = self::removeDangerousContent($html);

        // Strip all tags except allowed ones
        $html = strip_tags($html, '<' . implode('><', $allowedTags) . '>');

        // Sanitize attributes
        $html = self::sanitizeAttributes($html, $allowedAttributes);

        // Remove javascript: and data: protocols from links and images
        $html = preg_replace_callback(
            '/<(a|img)([^>]*)>/i',
            function ($matches) {
                $tag = $matches[1];
                $attrs = $matches[2];
                
                // Remove javascript:, data:, and vbscript: protocols
                $attrs = preg_replace(
                    '/(href|src)\s*=\s*["\']?\s*(javascript|data|vbscript):/i',
                    '$1=""',
                    $attrs
                );
                
                // Ensure external links have rel="noopener noreferrer"
                if ($tag === 'a' && preg_match('/target\s*=\s*["\']?_blank/i', $attrs)) {
                    if (!preg_match('/rel\s*=/i', $attrs)) {
                        $attrs .= ' rel="noopener noreferrer"';
                    }
                }
                
                return '<' . $tag . $attrs . '>';
            },
            $html
        );

        // Remove event handlers (onclick, onload, onerror, etc.)
        $html = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $html);
        
        // Remove style attributes that could contain malicious code
        $html = preg_replace_callback(
            '/style\s*=\s*["\']([^"\']*)["\']/',
            function ($matches) {
                $style = $matches[1];
                // Remove expression(), url(javascript:), and other dangerous CSS
                $style = preg_replace(
                    '/(expression|javascript|vbscript|import|behavior)\s*[\(:]/i',
                    '',
                    $style
                );
                return 'style="' . htmlspecialchars($style, ENT_QUOTES, 'UTF-8') . '"';
            },
            $html
        );

        return $html;
    }

    /**
     * Remove potentially dangerous content
     * 
     * @param string $html
     * @return string
     */
    private static function removeDangerousContent(string $html): string
    {
        // Remove script tags and their content
        $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html);
        
        // Remove iframe tags
        $html = preg_replace('/<iframe\b[^>]*>(.*?)<\/iframe>/is', '', $html);
        
        // Remove object tags
        $html = preg_replace('/<object\b[^>]*>(.*?)<\/object>/is', '', $html);
        
        // Remove embed tags
        $html = preg_replace('/<embed\b[^>]*>/is', '', $html);
        
        // Remove form tags
        $html = preg_replace('/<form\b[^>]*>(.*?)<\/form>/is', '', $html);
        
        // Remove input tags
        $html = preg_replace('/<input\b[^>]*>/is', '', $html);
        
        // Remove style tags with potentially malicious content
        $html = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $html);
        
        // Remove meta tags
        $html = preg_replace('/<meta\b[^>]*>/is', '', $html);
        
        // Remove link tags (external stylesheets could be malicious)
        $html = preg_replace('/<link\b[^>]*>/is', '', $html);
        
        // Remove base tags (could redirect resources)
        $html = preg_replace('/<base\b[^>]*>/is', '', $html);

        return $html;
    }

    /**
     * Sanitize HTML attributes
     * 
     * @param string $html
     * @param array $allowedAttributes
     * @return string
     */
    private static function sanitizeAttributes(string $html, array $allowedAttributes): string
    {
        return preg_replace_callback(
            '/<(\w+)([^>]*)>/i',
            function ($matches) use ($allowedAttributes) {
                $tag = strtolower($matches[1]);
                $attrs = $matches[2];
                
                if (!isset($allowedAttributes[$tag])) {
                    // No specific attributes allowed for this tag
                    return '<' . $tag . '>';
                }
                
                $allowed = $allowedAttributes[$tag];
                $sanitized = [];
                
                // Extract all attributes
                preg_match_all('/(\w+)\s*=\s*["\']([^"\']*)["\']/', $attrs, $attrMatches, PREG_SET_ORDER);
                
                foreach ($attrMatches as $attr) {
                    $attrName = strtolower($attr[1]);
                    $attrValue = $attr[2];
                    
                    // Only keep allowed attributes
                    if (in_array($attrName, $allowed)) {
                        // Escape the attribute value
                        $attrValue = htmlspecialchars($attrValue, ENT_QUOTES, 'UTF-8');
                        $sanitized[] = $attrName . '="' . $attrValue . '"';
                    }
                }
                
                $attrString = empty($sanitized) ? '' : ' ' . implode(' ', $sanitized);
                return '<' . $tag . $attrString . '>';
            },
            $html
        );
    }

    /**
     * Sanitize plain text (for non-HTML fields)
     * 
     * @param string|null $text
     * @return string|null
     */
    public static function sanitizeText(?string $text): ?string
    {
        if (empty($text)) {
            return $text;
        }

        // Remove all HTML tags
        $text = strip_tags($text);
        
        // Convert special characters to HTML entities
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        
        return $text;
    }
}
