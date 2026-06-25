<?php
/**
 * RoutineFlow — Exercise Tracker: Add Workout
 * ASSIGNED TO: Member B
 * 
 * ⚠️  READ plan.md → "AI Agent Prompt" section FIRST.
 * 
 * FORM FIELDS:
 * - activity_type: dropdown (Jogging, Cycling, Gym, Swimming, Yoga, Hiking, Other)
 * - duration_minutes: number input (min: 1)
 * - calories_burned: number input (min: 0)
 * - intensity: radio buttons (Low, Medium, High)
 * - exercise_date: date input
 * - notes: textarea (optional)
 * 
 * POST to: process.php with action=add
 * Include CSRF token: <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
 * 
 * LAYOUT: Single centered .glass-card form (see plan.md → Rule 5)
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$page_title = 'Add Workout';

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="plus"></i> Add Workout</h1>
        <p class="page-subtitle">Record a new exercise session</p>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>

    <!-- TODO: Build the add exercise form inside a .glass-card -->
    <div class="glass-card" style="max-width: 600px;">
      <p class="text-muted">Member B: Build the add exercise form here. See comments above for field details.</p>
    </div>

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
