<?php

/**
 * Application Configuration
 */

// Base URL
define('BASE_URL', 'http://localhost/spp_app/public');

// Application name
define('APP_NAME', 'SPP Payment');

// Environment (development/production)
define('ENVIRONMENT', 'development');

// Session configuration
define('SESSION_LIFETIME', 3600); // 1 hour in seconds

// Display errors in development
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Timezone
date_default_timezone_set('Asia/Jakarta');
