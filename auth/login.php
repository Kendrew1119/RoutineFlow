<?php
/**
 * RoutineFlow — Login Page
 * [LEADER] manages this file.
 * 
 * TODO: Build the login form UI with glassmorphism auth-card.
 * - Use .auth-wrapper, .auth-card, .glass-card classes from style.css
 * - Include CSRF token in form
 * - POST to process_auth.php with action=login
 * - Display flash error/success messages
 * - Link to register.php
 * 
 * See plan.md → "Shared Authentication Flow" for full details.
 */

require_once '../config/session.php';

// Redirect if already logged in
if (is_logged_in()) {
    header('Location: ../dashboard/index.php');
    exit;
}

$page_title = 'Login';
$error = get_flash('error');
$success = get_flash('success');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoutineFlow — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card glass-card">
            <!-- Logo -->
            <div class="logo">
                <i data-lucide="hexagon" class="logo-icon"></i>
                <span class="logo-text">RoutineFlow</span>
            </div>

            <h1 class="auth-title">Welcome back</h1>
            <p class="auth-subtitle">Sign in to continue your routine</p>

            <!-- Flash Messages -->
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i data-lucide="x-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i data-lucide="check-circle"></i> <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="process_auth.php" method="POST">
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="input-field" 
                           placeholder="Enter your username" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="input-field" 
                           placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; margin-top: var(--space-sm);">
                    <i data-lucide="log-in"></i> Sign In
                </button>
            </form>

            <p class="auth-footer">
                Don't have an account? <a href="register.php">Create one</a>
            </p>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
</body>
</html>
