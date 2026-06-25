<?php
/**
 * ========================================================
 * RoutineFlow — Exercise Tracker Module
 * ========================================================
 * ASSIGNED TO: Member B
 * TABLE: exercises (see database/schema.sql)
 * 
 * ⚠️  READ plan.md BEFORE writing any code!
 *     Especially the "AI Agent Prompt" section.
 * 
 * THIS FILE: index.php — List all exercise records (READ)
 * 
 * REQUIREMENTS:
 * - Display all exercises for the logged-in user as glass-cards in a grid
 * - Show: activity_type, duration, calories, intensity, date
 * - Each card has edit (pencil icon) and delete (trash icon) buttons
 * - Include a toolbar with search and filter (by activity_type, intensity)
 * - Optional: Add sorting (by date, calories)
 * - Optional: Add Chart.js graph showing weekly workout stats
 * 
 * CSS CLASSES TO USE: (from assets/css/style.css)
 *   Layout:  .main-content, .page-container, .page-header, .page-title
 *   Cards:   .glass-card, .glass-card-hover, .grid-3
 *   Buttons: .btn-primary, .btn-ghost, .btn-icon, .btn-sm
 *   Toolbar: .toolbar, .search-box, .input-field
 *   Badges:  .badge-primary, .badge-success, .badge-warning
 *   Empty:   .empty-state
 * 
 * ICONS TO USE: (Lucide — see https://lucide.dev/icons)
 *   <i data-lucide="dumbbell"></i>     — Module icon
 *   <i data-lucide="plus"></i>         — Add button
 *   <i data-lucide="pencil"></i>       — Edit button
 *   <i data-lucide="trash-2"></i>      — Delete button
 *   <i data-lucide="search"></i>       — Search icon
 *   <i data-lucide="filter"></i>       — Filter icon
 *   <i data-lucide="flame"></i>        — Calories icon
 *   <i data-lucide="clock"></i>        — Duration icon
 * ========================================================
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Exercise Tracker';

// TODO: Fetch all exercises for this user
// $stmt = $pdo->prepare("SELECT * FROM exercises WHERE user_id = ? ORDER BY exercise_date DESC");
// $stmt->execute([$user_id]);
// $exercises = $stmt->fetchAll();

$exercises = []; // Replace with query above

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
