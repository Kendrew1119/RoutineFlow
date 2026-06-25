<?php
/**
 * RoutineFlow — Exercise Tracker: Process (CRUD Handler)
 * ASSIGNED TO: Member B
 * 
 * Handles all form POST submissions for the exercise module.
 * 
 * Expected POST data:
 *   action = 'add' | 'edit'
 *   csrf_token = CSRF token
 *   activity_type, duration_minutes, calories_burned, intensity, exercise_date, notes
 *   exercise_id (only for edit)
 * 
 * PATTERN:
 * 1. Verify CSRF token
 * 2. Validate all inputs server-side
 * 3. Execute SQL (INSERT or UPDATE)
 * 4. Set flash message
 * 5. Redirect to index.php
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
