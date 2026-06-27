<?php
/**
 * RoutineFlow — Habit Tracker: Delete Handler
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

$habit_id = filter_var($_POST['habit_id'] ?? 0, FILTER_VALIDATE_INT);
if (!$habit_id) {
    set_flash('error', 'Invalid habit identifier.');
    header('Location: index.php');
    exit;
}

// Ownership verification
$stmt = $pdo->prepare("SELECT * FROM habits WHERE habit_id = ? AND user_id = ?");
$stmt->execute([$habit_id, $user_id]);
if (!$stmt->fetch()) {
    set_flash('error', 'Habit not found or access denied.');
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM habits WHERE habit_id = ? AND user_id = ?");
$stmt->execute([$habit_id, $user_id]);

set_flash('success', 'Habit deleted successfully!');
header('Location: index.php');
exit;

