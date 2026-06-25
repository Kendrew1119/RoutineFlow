<?php
/**
 * RoutineFlow — Session Configuration
 * 
 * READ plan.md FIRST before modifying this file.
 * This file is managed by the LEADER only.
 * 
 * Usage: require_once '../../config/session.php';
 * Must be included BEFORE any HTML output.
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    // Session security settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.cookie_samesite', 'Strict');
    
    session_start();
}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**
 * Verify CSRF token from form submission
 * Usage: verify_csrf($_POST['csrf_token']);
 */
function verify_csrf($token) {
    if (!isset($token) || $token !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = 'Invalid security token. Please try again.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

/**
 * Check if user is logged in
 * Returns true/false without redirecting
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if user is admin
 */
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Get current user ID
 */
function get_user_id() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Get current username
 */
function get_username() {
    return $_SESSION['username'] ?? 'Guest';
}

/**
 * Set flash message (success or error)
 * Usage: set_flash('success', 'Record saved!');
 */
function set_flash($type, $message) {
    $_SESSION[$type] = $message;
}

/**
 * Get and clear flash message
 * Usage: $msg = get_flash('success');
 */
function get_flash($type) {
    $msg = $_SESSION[$type] ?? null;
    unset($_SESSION[$type]);
    return $msg;
}
