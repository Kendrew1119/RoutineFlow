<?php
/**
 * RoutineFlow — Register Page
 * [LEADER] manages this file.
 * 
 * TODO: Build the registration form UI.
 * - Fields: username, email, password, confirm_password
 * - POST to process_auth.php with action=register
 * - Link to login.php
 */

require_once '../config/session.php';

if (is_logged_in()) {
    header('Location: ../dashboard/index.php');
    exit;
}

$page_title = 'Register';
$error = get_flash('error');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoutineFlow — Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card glass-card">
            <div class="logo">
                <i data-lucide="hexagon" class="logo-icon"></i>
                <span class="logo-text">RoutineFlow</span>
            </div>

            <h1 class="auth-title">Create account</h1>
            <p class="auth-subtitle">Start organizing your routine today</p>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i data-lucide="x-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="process_auth.php" method="POST">
                <input type="hidden" name="action" value="register">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="input-field" 
                           placeholder="Choose a username" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="input-field" 
                           placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="input-field" 
                           placeholder="Create a password (min 6 chars)" required minlength="6">
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="input-field" 
                           placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; margin-top: var(--space-sm);">
                    <i data-lucide="user-plus"></i> Create Account
                </button>
            </form>

            <p class="auth-footer">
                Already have an account? <a href="login.php">Sign in</a>
            </p>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
</body>
</html>
