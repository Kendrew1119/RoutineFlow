<?php
/**
 * RoutineFlow — Money Tracker: Edit Transaction
 * ASSIGNED TO: Member D
 * 
 * - Receives transaction_id via GET: edit.php?id=123
 * - Fetch existing record and pre-fill form
 * - POST to process.php with action=edit
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Edit Transaction';

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">
    <div class="page-header">
      <div><h1 class="page-title"><i data-lucide="pencil"></i> Edit Transaction</h1></div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>
    <div class="glass-card" style="max-width: 600px;">
      <p class="text-muted">Member D: Build the edit transaction form here. Same fields as add.php but pre-filled.</p>
    </div>
  </div>
</main>

<?php include '../../shared/footer.php'; ?>
