<?php
/**
 * RoutineFlow — Habit Tracker: Process (CRUD Handler)
 * ASSIGNED TO: Leader (Member A)
 */
require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

verify_csrf($_POST['csrf_token'] ?? '');
$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

// Pre-sanitize habit_id to ensure safe validation redirect URLs
$habit_id_raw = filter_var($_POST['habit_id'] ?? 0, FILTER_VALIDATE_INT);
$redirect_back = ($action === 'edit' && $habit_id_raw)
    ? 'edit.php?id=' . $habit_id_raw
    : 'add.php';

$habit_name = trim($_POST['habit_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$target_frequency = trim($_POST['target_frequency'] ?? 'daily');
$color = trim($_POST['color'] ?? '#06b6d4');
$icon = trim($_POST['icon'] ?? 'star');

// Validate name
if (empty($habit_name) || mb_strlen($habit_name) > 100) {
    set_flash('error', 'Habit name is required and must be under 100 characters.');
    header('Location: ' . $redirect_back);
    exit;
}

// Validate description
if (mb_strlen($description) > 255) {
    set_flash('error', 'Description must be under 255 characters.');
    header('Location: ' . $redirect_back);
    exit;
}

// Validate target frequency
$allowed_frequencies = ['daily', 'weekly', 'monthly'];
if (!in_array(strtolower($target_frequency), $allowed_frequencies, true)) {
    set_flash('error', 'Invalid target frequency.');
    header('Location: ' . $redirect_back);
    exit;
}

// Validate color format (HEX)
if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
    set_flash('error', 'Invalid color format.');
    header('Location: ' . $redirect_back);
    exit;
}

// Validate icon name (sanitize to alphanumeric with hyphens)
if (!preg_match('/^[a-zA-Z0-9\-]+$/', $icon)) {
    $icon = 'star';
}

if ($action === 'add') {
    $stmt = $pdo->prepare("INSERT INTO habits (user_id, habit_name, description, target_frequency, color, icon) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $habit_name, $description, $target_frequency, $color, $icon]);
    set_flash('success', 'Habit added successfully!');
    header('Location: index.php');
    exit;
} elseif ($action === 'edit') {
    $habit_id = filter_var($_POST['habit_id'] ?? 0, FILTER_VALIDATE_INT);
    if (!$habit_id) {
        set_flash('error', 'Invalid habit identifier.');
        header('Location: index.php');
        exit;
    }
    
    // Check ownership
    $stmt = $pdo->prepare("SELECT * FROM habits WHERE habit_id = ? AND user_id = ?");
    $stmt->execute([$habit_id, $user_id]);
    if (!$stmt->fetch()) {
        set_flash('error', 'Habit not found or access denied.');
        header('Location: index.php');
        exit;
    }
    
    $stmt = $pdo->prepare("UPDATE habits SET habit_name = ?, description = ?, target_frequency = ?, color = ?, icon = ? WHERE habit_id = ? AND user_id = ?");
    $stmt->execute([$habit_name, $description, $target_frequency, $color, $icon, $habit_id, $user_id]);
    set_flash('success', 'Habit updated successfully!');
    header('Location: index.php');
    exit;
}

set_flash('error', 'Invalid process action.');
header('Location: index.php');
exit;

