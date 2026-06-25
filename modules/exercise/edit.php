<?php
/**
 * RoutineFlow — Exercise Tracker: Edit Workout
 * ASSIGNED TO: Member B
 * 
 * ⚠️  READ plan.md → "AI Agent Prompt" section FIRST.
 * 
 * - Receives exercise_id via GET parameter: edit.php?id=123
 * - Fetch existing record: SELECT * FROM exercises WHERE exercise_id = ? AND user_id = ?
 * - Pre-fill form fields with existing data
 * - POST to process.php with action=edit
 * - Include exercise_id as hidden input
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Edit Workout';

// TODO: Get exercise_id from GET, fetch record, pre-fill form

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="pencil"></i> Edit Workout</h1>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>

    <div class="glass-card" style="max-width: 600px;">
      <p class="text-muted">Member B: Build the edit exercise form here. Same fields as add.php but pre-filled.</p>
    </div>

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
