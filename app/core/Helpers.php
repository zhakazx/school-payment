<?php

/**
 * Helper Functions
 * Global utility functions for authentication, flash messages, and sanitization
 */

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Require authentication - redirect to login if not authenticated
 */
function requireAuth() {
    if (!isLoggedIn()) {
        redirect('auth/index');
    }
}

/**
 * Get current user ID from session
 */
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Get current user data from session
 */
function getUser() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'nis' => $_SESSION['user_nis'] ?? null,
        'nama' => $_SESSION['user_nama'] ?? null,
    ];
}

/**
 * Set flash message
 */
function setFlash($key, $message, $type = 'info') {
    $_SESSION['flash'][$key] = [
        'message' => $message,
        'type' => $type
    ];
}

/**
 * Get and clear flash message
 */
function getFlash($key) {
    if (isset($_SESSION['flash'][$key])) {
        $flash = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $flash;
    }
    return null;
}

/**
 * Redirect helper
 */
function redirect($path) {
    $url = BASE_URL . '/' . ltrim($path, '/');
    header("Location: {$url}");
    exit;
}

/**
 * Sanitize input
 */
function sanitize($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = sanitize($value);
        }
        return $data;
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Escape output for HTML
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Format currency (Indonesian Rupiah)
 */
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

/**
 * Format date to Indonesian format
 */
function formatDate($date, $format = 'd/m/Y') {
    return date($format, strtotime($date));
}

/**
 * Get base URL
 */
function baseUrl($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Get asset URL
 */
function asset($path) {
    return BASE_URL . '/assets/' . ltrim($path, '/');
}
