#!/usr/bin/env php
<?php

/**
 * Security Configuration Verification Script
 * 
 * This script checks if all security configurations are properly set
 * Run: php verify_security.php
 */

echo "🔒 PKM Website Security Configuration Verification\n";
echo "=" . str_repeat("=", 70) . "\n\n";

$errors = [];
$warnings = [];
$passed = [];

// Check 1: Environment Configuration
echo "1️⃣  Checking Environment Configuration...\n";
if (!file_exists(__DIR__ . '/.env')) {
    $errors[] = ".env file not found! Copy .env.example to .env";
} else {
    $envContent = file_get_contents(__DIR__ . '/.env');
    
    // Check APP_ENV
    if (strpos($envContent, 'APP_ENV=production') !== false) {
        $passed[] = "APP_ENV is set to production";
        
        // In production, APP_DEBUG should be false
        if (strpos($envContent, 'APP_DEBUG=true') !== false) {
            $errors[] = "APP_DEBUG must be false in production!";
        } else {
            $passed[] = "APP_DEBUG is properly set to false";
        }
        
        // In production, FORCE_HTTPS should be true
        if (strpos($envContent, 'FORCE_HTTPS=true') !== false) {
            $passed[] = "FORCE_HTTPS is enabled";
        } else {
            $warnings[] = "FORCE_HTTPS should be true in production";
        }
        
        // SESSION_SECURE_COOKIE should be true
        if (strpos($envContent, 'SESSION_SECURE_COOKIE=true') !== false) {
            $passed[] = "SESSION_SECURE_COOKIE is enabled";
        } else {
            $warnings[] = "SESSION_SECURE_COOKIE should be true in production";
        }
    } else if (strpos($envContent, 'APP_ENV=local') !== false) {
        $passed[] = "APP_ENV is set to local (development mode)";
        $warnings[] = "Running in development mode - ensure production settings before deployment";
    }
}

// Check 2: Middleware Files
echo "\n2️⃣  Checking Middleware Files...\n";
$middlewareFiles = [
    'app/Http/Middleware/SetSecurityHeaders.php',
    'app/Http/Middleware/ForceHttps.php',
    'app/Http/Middleware/SanitizeInput.php',
];

foreach ($middlewareFiles as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        $passed[] = basename($file) . " exists";
    } else {
        $errors[] = "$file is missing!";
    }
}

// Check 3: Session Configuration
echo "\n3️⃣  Checking Session Configuration...\n";
$sessionConfig = __DIR__ . '/config/session.php';
if (file_exists($sessionConfig)) {
    $content = file_get_contents($sessionConfig);
    
    // Check HttpOnly flag
    if (strpos($content, "'http_only' => true") !== false) {
        $passed[] = "HttpOnly flag is enabled in session config";
    } else {
        $errors[] = "HttpOnly flag must be enabled in config/session.php";
    }
    
    // Check SameSite setting
    if (strpos($content, "'same_site' => 'strict'") !== false) {
        $passed[] = "SameSite is set to 'strict'";
    } else {
        $warnings[] = "SameSite should be 'strict' for maximum security";
    }
} else {
    $errors[] = "config/session.php not found!";
}

// Check 4: Routes Configuration
echo "\n4️⃣  Checking Routes Configuration...\n";
$routesFile = __DIR__ . '/routes/web.php';
if (file_exists($routesFile)) {
    $content = file_get_contents($routesFile);
    
    // Check for rate limiting on comment routes
    if (strpos($content, 'throttle:') !== false) {
        $passed[] = "Rate limiting is configured on routes";
    } else {
        $warnings[] = "Consider adding rate limiting to comment routes";
    }
    
    $passed[] = "Routes file exists";
} else {
    $errors[] = "routes/web.php not found!";
}

// Check 5: Kernel Configuration
echo "\n5️⃣  Checking HTTP Kernel Configuration...\n";
$kernelFile = __DIR__ . '/app/Http/Kernel.php';
if (file_exists($kernelFile)) {
    $content = file_get_contents($kernelFile);
    
    // Check if SanitizeInput is registered
    if (strpos($content, 'SanitizeInput::class') !== false) {
        $passed[] = "SanitizeInput middleware is registered";
    } else {
        $errors[] = "SanitizeInput middleware is not registered in Kernel.php!";
    }
    
    // Check if SetSecurityHeaders is registered
    if (strpos($content, 'SetSecurityHeaders::class') !== false) {
        $passed[] = "SetSecurityHeaders middleware is registered";
    } else {
        $errors[] = "SetSecurityHeaders middleware is not registered in Kernel.php!";
    }
} else {
    $errors[] = "app/Http/Kernel.php not found!";
}

// Check 6: File Permissions
echo "\n6️⃣  Checking File Permissions...\n";
$storageDir = __DIR__ . '/storage';
$bootstrapCache = __DIR__ . '/bootstrap/cache';

if (is_writable($storageDir)) {
    $passed[] = "storage/ directory is writable";
} else {
    $errors[] = "storage/ directory must be writable by web server!";
}

if (is_writable($bootstrapCache)) {
    $passed[] = "bootstrap/cache/ directory is writable";
} else {
    $errors[] = "bootstrap/cache/ directory must be writable by web server!";
}

// Check 7: Documentation
echo "\n7️⃣  Checking Security Documentation...\n";
$docs = [
    'SECURITY_FIXES.md',
    'SECURITY_CHECKLIST.md',
    'SECURITY_SUMMARY.md',
];

foreach ($docs as $doc) {
    if (file_exists(__DIR__ . '/' . $doc)) {
        $passed[] = "$doc exists";
    } else {
        $warnings[] = "$doc documentation is missing";
    }
}

// Results Summary
echo "\n\n" . str_repeat("=", 70) . "\n";
echo "📊 VERIFICATION RESULTS\n";
echo str_repeat("=", 70) . "\n\n";

if (count($passed) > 0) {
    echo "✅ PASSED (" . count($passed) . "):\n";
    foreach ($passed as $item) {
        echo "   ✓ $item\n";
    }
    echo "\n";
}

if (count($warnings) > 0) {
    echo "⚠️  WARNINGS (" . count($warnings) . "):\n";
    foreach ($warnings as $item) {
        echo "   ! $item\n";
    }
    echo "\n";
}

if (count($errors) > 0) {
    echo "❌ ERRORS (" . count($errors) . "):\n";
    foreach ($errors as $item) {
        echo "   ✗ $item\n";
    }
    echo "\n";
}

// Final Status
echo str_repeat("=", 70) . "\n";
if (count($errors) === 0) {
    echo "🎉 SECURITY STATUS: ";
    if (count($warnings) === 0) {
        echo "EXCELLENT - All checks passed!\n";
    } else {
        echo "GOOD - Review warnings before production deployment\n";
    }
    echo "✅ Application is ready for secure deployment\n";
} else {
    echo "⛔ SECURITY STATUS: NEEDS ATTENTION\n";
    echo "❌ Fix all errors before deploying to production!\n";
}
echo str_repeat("=", 70) . "\n\n";

// Exit with appropriate code
exit(count($errors) > 0 ? 1 : 0);
