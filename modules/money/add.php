<?php
/**
 * RoutineFlow — Money Tracker: Add Transaction
 * ASSIGNED TO: Member D
 * 
 * ⚠️  READ plan.md → "AI Agent Prompt" section FIRST.
 * 
 * FORM FIELDS:
 * - amount: number input (step 0.01, min 0.01)
 * - category: dropdown (Food, Transport, Entertainment, Shopping, Bills, Education, Salary, Freelance, Other)
 * - description: text input (optional, max 255 chars)
 * - transaction_type: radio buttons (Income / Expense)
 * - transaction_date: date input (default: today)
 * 
 * POST to: process.php with action=add
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$page_title = 'Add Transaction';

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">
    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="plus"></i> Add Transaction</h1>
        <p class="page-subtitle">Record income or expense</p>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>
    <div class="glass-card" style="max-width: 600px;">
      <p class="text-muted">Member D: Build the add transaction form here. See comments above for field details.</p>
    </div>
  </div>
</main>

<?php include '../../shared/footer.php'; ?>
