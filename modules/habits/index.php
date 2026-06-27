<?php
/**
 * RoutineFlow — Habit Tracker Module
 * ASSIGNED TO: Leader (Member A)
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';
require_once 'helpers.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Habit Tracker';

// Fetch all habits
$stmt = $pdo->prepare("SELECT * FROM habits WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$habits = $stmt->fetchAll();

$today = date('Y-m-d');

// Fetch flash messages
$success = get_flash('success');
$error = get_flash('error');

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">
    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="target"></i> Habit Tracker</h1>
        <p class="page-subtitle">Build habits, maintain your streak, transform your routine</p>
      </div>
      <a href="add.php" class="btn btn-primary"><i data-lucide="plus"></i> New Habit</a>
    </div>

    <!-- Flash Alerts -->
    <?php if ($success): ?>
      <div class="alert alert-success animate__animated animate__fadeIn" style="margin-bottom: var(--space-md);">
        <i data-lucide="check-circle"></i> <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="alert alert-error animate__animated animate__fadeIn" style="margin-bottom: var(--space-md);">
        <i data-lucide="x-circle"></i> <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if (empty($habits)): ?>
      <div class="glass-card text-center" style="padding: var(--space-3xl); text-align: center;">
        <div style="background: rgba(var(--color-primary-rgb), 0.1); width: 80px; height: 80px; border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-lg) auto;">
          <i data-lucide="target" style="width: 40px; height: 40px; color: var(--color-dark);"></i>
        </div>
        <h2>No habits created yet</h2>
        <p class="text-muted" style="margin-top: var(--space-sm); margin-bottom: var(--space-lg);">Get started by creating your first daily, weekly, or monthly habit.</p>
        <a href="add.php" class="btn btn-primary"><i data-lucide="plus"></i> Create Habit</a>
      </div>
    <?php else: ?>
      <div class="habits-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: var(--space-lg);">
        <?php foreach ($habits as $h): 
          // Fetch completions for this habit
          $stmt_comp = $pdo->prepare("SELECT completion_date, status FROM habit_completions WHERE habit_id = ? ORDER BY completion_date DESC");
          $stmt_comp->execute([$h['habit_id']]);
          $completions = $stmt_comp->fetchAll();

          $streak = calculateStreak($completions);
          $progress = calculateWeeklyProgress($completions, $h['target_frequency']);

          // Check if completed today
          $completed_today = false;
          foreach ($completions as $c) {
              if ($c['completion_date'] === $today) {
                  $completed_today = ($c['status'] === 'completed');
                  break;
              }
          }
          
          // Radius = 22. Circumference = 2 * PI * r ≈ 138.23
          $circumference = 138.23;
          $dashoffset = $circumference - ($circumference * $progress / 100);
        ?>
          <div class="glass-card habit-card" id="habit-card-<?= $h['habit_id'] ?>" style="display: flex; flex-direction: column; justify-content: space-between; border-left: 6px solid <?= htmlspecialchars($h['color']) ?>; transition: var(--transition-base);">
            
            <!-- Habit Header Info -->
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: var(--space-md);">
              <div style="display: flex; gap: var(--space-md); align-items: center;">
                <div style="background: <?= htmlspecialchars($h['color']) ?>20; color: <?= htmlspecialchars($h['color']) ?>; width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                  <i data-lucide="<?= htmlspecialchars($h['icon']) ?>" style="width: 24px; height: 24px;"></i>
                </div>
                <div>
                  <h3 style="font-size: var(--font-size-base); font-weight: 600; color: var(--color-dark); margin: 0;">
                    <?= htmlspecialchars($h['habit_name']) ?>
                  </h3>
                  <span class="badge" style="font-size: 10px; background: rgba(0,0,0,0.05); padding: 2px 8px; border-radius: var(--radius-sm); text-transform: uppercase; font-weight: 700; margin-top: 4px; display: inline-block;">
                    <?= htmlspecialchars($h['target_frequency']) ?>
                  </span>
                </div>
              </div>

              <!-- Weekly Progress Ring -->
              <div style="position: relative; width: 52px; height: 52px;" title="Weekly Completion Progress">
                <svg width="52" height="52" style="transform: rotate(-90deg);">
                  <circle cx="26" cy="26" r="22" stroke="rgba(0,0,0,0.05)" stroke-width="4" fill="transparent" />
                  <circle class="progress-ring-circle" id="progress-circle-<?= $h['habit_id'] ?>" cx="26" cy="26" r="22" 
                          stroke="<?= htmlspecialchars($h['color']) ?>" stroke-width="4" stroke-linecap="round" fill="transparent" 
                          stroke-dasharray="<?= $circumference ?>" stroke-dashoffset="<?= $dashoffset ?>" style="transition: stroke-dashoffset 0.3s ease;" />
                </svg>
                <div class="progress-ring-text" id="progress-text-<?= $h['habit_id'] ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: var(--color-dark);">
                  <?= $progress ?>%
                </div>
              </div>
            </div>

            <!-- Description -->
            <?php if (!empty($h['description'])): ?>
              <p class="text-muted" style="font-size: var(--font-size-sm); margin-bottom: var(--space-md); flex: 1;">
                <?= htmlspecialchars($h['description']) ?>
              </p>
            <?php else: ?>
              <p class="text-muted" style="font-size: var(--font-size-sm); margin-bottom: var(--space-md); flex: 1; opacity: 0.3; font-style: italic;">
                No description provided.
              </p>
            <?php endif; ?>

            <!-- Action Controls / Completion Toggle -->
            <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid rgba(0,0,0,0.05); padding-top: var(--space-md);">
              <div style="display: flex; gap: var(--space-sm); align-items: center;">
                <span style="font-size: var(--font-size-sm); font-weight: 600; color: var(--color-dark); display: flex; align-items: center; gap: 4px;">
                  <i data-lucide="flame" style="width: 16px; height: 16px; color: #ff5a00; fill: #ff5a00;"></i> 
                  <span id="streak-count-<?= $h['habit_id'] ?>"><?= $streak ?></span> days
                </span>
              </div>

              <div style="display: flex; gap: var(--space-sm); align-items: center;">
                <!-- Edit & Delete Buttons -->
                <a href="edit.php?id=<?= $h['habit_id'] ?>" class="btn btn-ghost btn-sm" style="padding: 6px 8px;" title="Edit Habit">
                  <i data-lucide="pencil" style="width: 16px; height: 16px;"></i>
                </a>
                
                <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this habit?');" style="display: inline;">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">
                  <input type="hidden" name="habit_id" value="<?= $h['habit_id'] ?>">
                  <button type="submit" class="btn btn-ghost btn-sm text-danger" style="padding: 6px 8px; background: transparent; border: none; cursor: pointer;" title="Delete Habit">
                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                  </button>
                </form>

                <!-- Check Completion Toggle -->
                <button class="btn <?= $completed_today ? 'btn-success' : 'btn-secondary' ?> toggle-btn" 
                        id="toggle-btn-<?= $h['habit_id'] ?>"
                        onclick="toggleHabit(<?= $h['habit_id'] ?>)" 
                        style="padding: 6px 12px; border-radius: var(--radius-sm); font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                  <i data-lucide="<?= $completed_today ? 'check' : 'circle' ?>" id="toggle-icon-<?= $h['habit_id'] ?>" style="width: 14px; height: 14px;"></i>
                  <span id="toggle-text-<?= $h['habit_id'] ?>"><?= $completed_today ? 'Done' : 'Mark Done' ?></span>
                </button>
              </div>
            </div>

          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</main>

<script>
const CSRF_TOKEN = <?= json_encode($_SESSION['csrf_token']) ?>;

async function toggleHabit(habitId) {
    const btn = document.getElementById(`toggle-btn-${habitId}`);
    const icon = document.getElementById(`toggle-icon-${habitId}`);
    const text = document.getElementById(`toggle-text-${habitId}`);
    const streakCount = document.getElementById(`streak-count-${habitId}`);
    const circle = document.getElementById(`progress-circle-${habitId}`);
    const progressText = document.getElementById(`progress-text-${habitId}`);

    if (!btn) return;
    
    // Optimistically disable/fade button
    btn.style.opacity = '0.7';
    btn.disabled = true;

    try {
        const response = await fetch('ajax_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': CSRF_TOKEN
            },
            body: JSON.stringify({
                action: 'toggle_complete',
                habit_id: habitId
            })
        });

        const data = await response.json();
        
        if (data.success) {
            // Update button styles and labels
            if (data.status === 'completed') {
                btn.className = 'btn btn-success toggle-btn';
                icon.setAttribute('data-lucide', 'check');
                text.textContent = 'Done';
            } else {
                btn.className = 'btn btn-secondary toggle-btn';
                icon.setAttribute('data-lucide', 'circle');
                text.textContent = 'Mark Done';
            }
            
            // Re-render Lucide icons inside toggle button
            lucide.createIcons({
                attrs: {
                    class: 'lucide'
                },
                nameAttr: 'data-lucide',
                root: btn
            });

            // Update stats
            streakCount.textContent = data.streak;
            progressText.textContent = `${data.progress}%`;
            
            // Animate progress ring
            const circumference = 138.23;
            const newOffset = circumference - (circumference * data.progress / 100);
            circle.style.strokeDashoffset = newOffset;
            
            // Micro-animation bounce on success
            btn.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => btn.classList.remove('animate__animated', 'animate__pulse'), 500);

        } else {
            alert('Error updating habit completion: ' + (data.error || 'Unknown error'));
        }
    } catch (e) {
        console.error(e);
        alert('Network or server error during habit update.');
    } finally {
        btn.style.opacity = '1';
        btn.disabled = false;
    }
}
</script>

<?php include '../../shared/footer.php'; ?>

