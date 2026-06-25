<?php
/**
 * RoutineFlow — Habit Tracker: Add Habit
 * ASSIGNED TO: Leader (Member A)
 * 
 * FORM FIELDS:
 * - habit_name: text input (max 100 chars)
 * - description: text input (optional, max 255 chars)
 * - target_frequency: dropdown (Daily, Weekly, Monthly)
 * - color: color picker input (default: #06b6d4)
 * - icon: icon selector (star, heart, book, dumbbell, etc.)
 * 
 * POST to: process.php with action=add
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$page_title = 'New Habit';

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">
    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="plus"></i> New Habit</h1>
        <p class="page-subtitle">Create a habit to track daily</p>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>
    <div class="glass-card" style="max-width: 600px;">
      <p class="text-muted">Leader: Build the add habit form here. See comments above for field details.</p>
    </div>
  </div>
</main>

<?php include '../../shared/footer.php'; ?>
