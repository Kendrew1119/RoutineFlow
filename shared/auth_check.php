<?php
/**
 * RoutineFlow — Authentication Guard
 * 
 * Include this file at the top of any page that requires login.
 * It redirects unauthenticated users to the login page.
 * 
 * Usage: require_once '../../shared/auth_check.php';
 * Must be included AFTER session.php
 */

if (!is_logged_in()) {
    $_SESSION['error'] = 'Please log in to continue.';
    // Calculate path to auth/login.php relative to the project root
    $root = dirname(__DIR__);
    header('Location: /serverside/auth/login.php');
    exit;
}
