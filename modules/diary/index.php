<?php
/**
 * ========================================================
 * RoutineFlow — Diary Journal Module
 * ========================================================
 * ASSIGNED TO: Member C
 * TABLE: diary_entries (see database/schema.sql)
 * 
 * ⚠️  READ plan.md BEFORE writing any code!
 *     Especially the "AI Agent Prompt" section.
 * 
 * THIS FILE: index.php — List all diary entries (READ)
 * 
 * REQUIREMENTS:
 * - Display journal entries for the logged-in user as glass-cards
 * - Show: title, content preview (truncated), mood emoji, date
 * - Each card has edit and delete buttons
 * - Mood displayed as emoji: happy=😊, excited=🤩, neutral=😐, sad=😢, angry=😠, anxious=😰
 * - Include search bar (search by title/content)
 * - Optional: Filter by mood
 * - Optional: Show daily motivational quote from ZenQuotes API
 * 
 * ICONS: <i data-lucide="book-heart"></i> (module icon)
 * ========================================================
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Diary Journal';

// TODO: Fetch all diary entries for this user
$entries = [];

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
