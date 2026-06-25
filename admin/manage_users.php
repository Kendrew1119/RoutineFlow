<?php
/**
 * RoutineFlow — Admin: Manage Users
 * [LEADER] manages this file.
 * 
 * TODO: Implement user management (view details, toggle roles, etc.)
 * Only accessible when $_SESSION['role'] === 'admin'.
 */

require_once '../config/session.php';
require_once '../config/db.php';
require_once '../shared/auth_check.php';

if (!is_admin()) {
    set_flash('error', 'Access denied.');
    header('Location: ../dashboard/index.php');
    exit;
}

$page_title = 'Manage Users';

// TODO: Implement user management logic

include '../shared/header.php';
include '../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">
    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="users"></i> Manage Users</h1>
        <p class="page-subtitle">View and manage registered users</p>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>

    <div class="glass-card">
      <div class="empty-state">
        <i data-lucide="wrench"></i>
        <p>User management features to be implemented.</p>
      </div>
    </div>
  </div>
</main>

<?php include '../shared/footer.php'; ?>
