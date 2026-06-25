<?php
/**
 * RoutineFlow — Exercise Tracker: Delete Handler
 * ASSIGNED TO: Member B
 * 
 * - Receives exercise_id via GET: delete.php?id=123
 * - Verify the record belongs to the current user
 * - DELETE FROM exercises WHERE exercise_id = ? AND user_id = ?
 * - Set flash success/error message
 * - Redirect back to index.php
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];

// TODO: Implement delete logic

set_flash('error', 'Delete not yet implemented.');
header('Location: index.php');
exit;
