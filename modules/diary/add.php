<?php
/**
 * RoutineFlow — Diary Journal: Add Entry
 * ASSIGNED TO: Member C
 * 
 * ⚠️  READ plan.md → "AI Agent Prompt" section FIRST.
 * 
 * FORM FIELDS:
 * - title: text input (max 200 chars)
 * - content: textarea (required)
 * - mood: mood selector using .mood-selector .mood-option classes
 *   Options: happy(😊), excited(🤩), neutral(😐), sad(😢), angry(😠), anxious(😰)
 * - tags: text input (comma-separated, optional)
 * - entry_date: date input (default: today)
 * 
 * POST to: process.php with action=add
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$page_title = 'New Journal Entry';

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="plus"></i> New Entry</h1>
        <p class="page-subtitle">Record your thoughts and mood</p>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>

    <div class="glass-card" style="max-width: 600px;">
      <p class="text-muted">Member C: Build the add diary entry form here. See comments above for field details.</p>
    </div>

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
