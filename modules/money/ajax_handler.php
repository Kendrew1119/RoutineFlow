<?php
/**
 * RoutineFlow — Money Tracker: AJAX Handler
 * ASSIGNED TO: Member D
 * 
 * Actions: delete, filter (by category, type, date range), export_csv
 */
require_once '../../config/session.php';
require_once '../../config/db.php';

header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

// TODO: Implement AJAX actions

echo json_encode(['success' => false, 'error' => 'Action not implemented']);
