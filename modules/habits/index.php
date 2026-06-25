<?php
/**
 * ========================================================
 * RoutineFlow — Habit Tracker Module
 * ========================================================
 * ASSIGNED TO: Leader (Member A)
 * TABLES: habits + habit_completions (see database/schema.sql)
 * 
 * THIS FILE: index.php — List all habits with completion status
 * 
 * REQUIREMENTS:
 * - Display habits as glass-cards with progress rings
 * - Show: habit name, icon, color, streak count, today's completion status
 * - Toggle habit complete/incomplete via AJAX (click to mark done)
 * - Progress ring shows weekly completion percentage
 * - Each card has edit and delete buttons
 * - Optional: Streak counter with fire emoji 🔥
 * - Optional: Calendar heatmap view
 * 
 * ICONS: <i data-lucide="target"></i> (module icon)
 *        <i data-lucide="check-circle"></i> (completed)
 *        <i data-lucide="circle"></i> (not completed)
 *        <i data-lucide="flame"></i> (streak)
 * ========================================================
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Habit Tracker';

// TODO: Fetch all habits with today's completion status
$habits = [];

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
