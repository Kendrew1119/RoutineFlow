<?php
/**
 * RoutineFlow — Authentication Processor
 * [LEADER] manages this file.
 * 
 * Handles POST requests for login and register actions.
 * Validates inputs, hashes passwords, manages sessions.
 */

require_once '../config/session.php';
require_once '../config/db.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// Verify CSRF token
verify_csrf($_POST['csrf_token'] ?? '');

$action = $_POST['action'] ?? '';

// ============================================
// REGISTER
// ============================================
if ($action === 'register') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        set_flash('error', 'All fields are required.');
        header('Location: register.php');
        exit;
    }

    if (strlen($username) < 3 || strlen($username) > 50) {
        set_flash('error', 'Username must be 3–50 characters.');
        header('Location: register.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash('error', 'Please enter a valid email address.');
        header('Location: register.php');
        exit;
    }

    if (strlen($password) < 6) {
        set_flash('error', 'Password must be at least 6 characters.');
        header('Location: register.php');
        exit;
    }

    if ($password !== $confirm) {
        set_flash('error', 'Passwords do not match.');
        header('Location: register.php');
        exit;
    }

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        set_flash('error', 'Username or email already taken.');
        header('Location: register.php');
        exit;
    }

    // Create user
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'student')");
    $stmt->execute([$username, $email, $hashed]);

    set_flash('success', 'Account created! Please sign in.');
    header('Location: login.php');
    exit;
}

// ============================================
// LOGIN
// ============================================
if ($action === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        set_flash('error', 'Please enter username and password.');
        header('Location: login.php');
        exit;
    }

    // Find user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        set_flash('error', 'Invalid username or password.');
        header('Location: login.php');
        exit;
    }

    // Set session variables
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['email'] = $user['email'];

    // Regenerate session ID for security
    session_regenerate_id(true);

    // Redirect based on role
    if ($user['role'] === 'admin') {
        header('Location: ../admin/index.php');
    } else {
        header('Location: ../dashboard/index.php');
    }
    exit;
}

// Unknown action
header('Location: login.php');
exit;
