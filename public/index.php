<?php

/**
 * Front Controller
 * Entry point for all requests
 */

// Start session
session_start();

// Load configuration
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';

// Load core classes
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Helpers.php';
require_once __DIR__ . '/../app/core/Router.php';

// Initialize router
new Router();
