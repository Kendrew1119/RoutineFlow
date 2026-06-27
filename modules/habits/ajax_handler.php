<?php
/**
 * RoutineFlow — Habit Tracker: AJAX Handler
 * ASSIGNED TO: Leader (Member A)
 */
require_once '../../config/session.php';
require_once '../../config/db.php';
require_once 'helpers.php';

header('Content-Type: application/json');

// Session check
if (!is_logged_in()) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];

// CSRF validation via custom X-CSRF-Token header
$headers = getallheaders();
$csrf_header = $headers['X-CSRF-Token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

if (empty($csrf_header) || $csrf_header !== ($_SESSION['csrf_token'] ?? '')) {
    echo json_encode(['success' => false, 'error' => 'Invalid security token']);
    exit;
}

// Parse request input
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$habit_id = filter_var($input['habit_id'] ?? 0, FILTER_VALIDATE_INT);

$allowed_actions = ['toggle_complete', 'delete'];
if (!in_array($action, $allowed_actions, true)) {
    echo json_encode(['success' => false, 'error' => 'Action not implemented']);
    exit;
}

if (!$habit_id) {
    echo json_encode(['success' => false, 'error' => 'Invalid habit identifier']);
    exit;
}

// Ownership verification
$stmt = $pdo->prepare("SELECT * FROM habits WHERE habit_id = ? AND user_id = ?");
$stmt->execute([$habit_id, $user_id]);
$habit = $stmt->fetch();

if (!$habit) {
    echo json_encode(['success' => false, 'error' => 'Habit not found or access denied']);
    exit;
}

if ($action === 'toggle_complete') {
    $today = date('Y-m-d');
    
    // Check if completion entry exists for today
    $stmt = $pdo->prepare("SELECT * FROM habit_completions WHERE habit_id = ? AND completion_date = ?");
    $stmt->execute([$habit_id, $today]);
    $completion = $stmt->fetch();
    
    if ($completion) {
        $new_status = $completion['status'] === 'completed' ? 'missed' : 'completed';
        $stmt = $pdo->prepare("UPDATE habit_completions SET status = ? WHERE completion_id = ?");
        $stmt->execute([$new_status, $completion['completion_id']]);
    } else {
        $new_status = 'completed';
        $stmt = $pdo->prepare("INSERT INTO habit_completions (habit_id, user_id, completion_date, status) VALUES (?, ?, ?, 'completed')");
        $stmt->execute([$habit_id, $user_id, $today]);
    }
    
    // Fetch updated completion list to recalculate stats
    $stmt = $pdo->prepare("SELECT completion_date, status FROM habit_completions WHERE habit_id = ? ORDER BY completion_date DESC");
    $stmt->execute([$habit_id]);
    $completions = $stmt->fetchAll();
    
    $streak = calculateStreak($completions);
    $progress = calculateWeeklyProgress($completions, $habit['target_frequency']);
    
    echo json_encode([
        'success' => true,
        'status' => $new_status,
        'streak' => $streak,
        'progress' => $progress
    ]);
    exit;

} elseif ($action === 'delete') {
    // Delete habit (completions will be cascade deleted)
    $stmt = $pdo->prepare("DELETE FROM habits WHERE habit_id = ? AND user_id = ?");
    $stmt->execute([$habit_id, $user_id]);
    
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'error' => 'Action not implemented']);

