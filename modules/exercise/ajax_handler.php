<?php
/**
 * RoutineFlow — Exercise Tracker: AJAX Handler
 * ASSIGNED TO: Member B
 * 
 * Handles AJAX requests (JSON in, JSON out).
 * 
 * Expected JSON body:
 *   { "action": "delete", "id": 123 }
 *   { "action": "search", "query": "jogging" }
 *   { "action": "filter", "intensity": "high" }
 * 
 * Response format:
 *   { "success": true, "data": [...] }
 *   { "success": false, "error": "message" }
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

// TODO: Implement AJAX actions (delete, search, filter)

echo json_encode(['success' => false, 'error' => 'Action not implemented']);
