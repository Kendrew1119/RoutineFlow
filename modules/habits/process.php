<?php
/**
 * RoutineFlow — Habit Tracker: Process (CRUD Handler)
 * ASSIGNED TO: Leader (Member A)
 * 
 * POST fields: action, csrf_token, habit_name, description, target_frequency, color, icon
 * For edit: also includes habit_id
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

// TODO: Implement add and edit logic

set_flash('error', 'Process not yet implemented.');
header('Location: index.php');
exit;
