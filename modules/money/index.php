<?php
/**
 * ========================================================
 * RoutineFlow — Money Tracker Module
 * ========================================================
 * ASSIGNED TO: Member D
 * TABLE: transactions (see database/schema.sql)
 * 
 * ⚠️  READ plan.md BEFORE writing any code!
 *     Especially the "AI Agent Prompt" section.
 * 
 * THIS FILE: index.php — List all financial records (READ)
 * 
 * REQUIREMENTS:
 * - Display transactions for the logged-in user as glass-cards or data-table
 * - Show: amount (green for income, red for expense), category, description, date
 * - Income/Expense toggle filter
 * - Category filter dropdown
 * - Show total income, total expense, and net balance at the top as stat-cards
 * - Optional: Chart.js pie chart for expense breakdown by category
 * - Optional: CSV export button
 * 
 * ICONS: <i data-lucide="wallet"></i> (module icon)
 *        <i data-lucide="trending-up"></i> (income)
 *        <i data-lucide="trending-down"></i> (expense)
 * ========================================================
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Money Tracker';

// TODO: Fetch all transactions and calculate totals
$transactions = [];
$totalIncome = 0;
$totalExpense = 0;

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

  </div>
</main>

<?php include '../../shared/footer.php'; ?>
