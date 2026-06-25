<?php
/**
 * RoutineFlow — Admin Dashboard
 * [LEADER] manages this file.
 * 
 * Admin-only page showing all registered users and system stats.
 * Only accessible when $_SESSION['role'] === 'admin'.
 */

require_once '../config/session.php';
require_once '../config/db.php';
require_once '../shared/auth_check.php';

// Admin-only guard
if (!is_admin()) {
    set_flash('error', 'Access denied. Admin privileges required.');
    header('Location: ../dashboard/index.php');
    exit;
}

$page_title = 'Admin Panel';

// TODO: Fetch system statistics
// $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
// $users = $pdo->query("SELECT user_id, username, email, role, created_at FROM users ORDER BY created_at DESC")->fetchAll();

$userCount = 0;
$users = [];

include '../shared/header.php';
include '../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

    <div class="page-header">
      <div>
        <h1 class="page-title">
          <i data-lucide="shield"></i> Admin Panel
        </h1>
        <p class="page-subtitle">System overview and user management</p>
      </div>
    </div>

    <!-- Stats -->
    <div class="grid-4 mb-xl">
      <div class="glass-card stat-card">
        <div class="stat-value text-gradient"><?= $userCount ?></div>
        <div class="stat-label">Total Users</div>
      </div>
      <!-- TODO: Add more stats (total records per module, etc.) -->
    </div>

    <!-- User List -->
    <div class="glass-card">
      <h2 class="text-lg font-semibold mb-lg">Registered Users</h2>
      <?php if (empty($users)): ?>
        <div class="empty-state">
          <i data-lucide="users"></i>
          <p>No users registered yet. Uncomment the queries above after database setup.</p>
        </div>
      <?php else: ?>
        <table class="data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Joined</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user['user_id'] ?></td>
              <td><?= htmlspecialchars($user['username']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><span class="badge <?= $user['role'] === 'admin' ? 'badge-danger' : 'badge-primary' ?>"><?= $user['role'] ?></span></td>
              <td class="text-muted"><?= date('d M Y', strtotime($user['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>

  </div>
</main>

<?php include '../shared/footer.php'; ?>
