<?php
/**
 * RoutineFlow — Habit Tracker: Edit Habit
 * ASSIGNED TO: Leader (Member A)
 */

require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Edit Habit';

// Fetch existing record
$habit_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$habit_id) {
    set_flash('error', 'Invalid habit identifier.');
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM habits WHERE habit_id = ? AND user_id = ?");
$stmt->execute([$habit_id, $user_id]);
$habit = $stmt->fetch();

if (!$habit) {
    set_flash('error', 'Habit not found or access denied.');
    header('Location: index.php');
    exit;
}

// Retrieve flash errors or successes
$error = get_flash('error');
$success = get_flash('success');

include '../../shared/header.php';
include '../../shared/navbar.php';
?>

<style>
.habit-editor-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--space-lg);
    max-width: 1000px;
    margin: 0 auto;
    align-items: start;
}
@media (min-width: 768px) {
    .habit-editor-layout {
        grid-template-columns: 1.2fr 1fr;
    }
    .form-column {
        grid-column: 1;
        grid-row: 1;
        align-self: start;
    }
    .preview-column {
        grid-column: 2;
        grid-row: 1;
        align-self: center;
    }
}
</style>

<main class="main-content">
  <div class="page-container">
    <div class="page-header">
      <div>
        <h1 class="page-title"><i data-lucide="pencil"></i> Edit Habit</h1>
        <p class="page-subtitle">Update your habit details</p>
      </div>
      <a href="index.php" class="btn btn-ghost"><i data-lucide="arrow-left"></i> Back</a>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-error animate__animated animate__fadeIn" style="margin-bottom: var(--space-md);">
        <i data-lucide="x-circle"></i> <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <div class="habit-editor-layout">

      <!-- Live Preview Column (Stacks on top on mobile, right on desktop) -->
      <div class="preview-column" style="width: 100%;">
        <div class="form-label" style="display: block; margin-bottom: var(--space-sm); font-weight: 600;">Live Card Preview</div>
        <div class="glass-card" id="habit-preview-card" style="display: flex; flex-direction: column; justify-content: space-between; border-left: 6px solid <?= htmlspecialchars($habit['color']) ?>; padding: var(--space-md); transition: var(--transition-base);">
          
          <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: var(--space-sm);">
            <div style="display: flex; gap: var(--space-md); align-items: center;">
              <div id="preview-icon-bg" style="background: <?= htmlspecialchars($habit['color']) ?>20; color: <?= htmlspecialchars($habit['color']) ?>; width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; transition: var(--transition-base);">
                <i id="preview-icon" data-lucide="<?= htmlspecialchars($habit['icon']) ?>" style="width: 24px; height: 24px;"></i>
              </div>
              <div>
                <h3 id="preview-name" style="font-size: var(--font-size-base); font-weight: 600; color: var(--color-dark); margin: 0;"><?= htmlspecialchars($habit['habit_name']) ?></h3>
                <span id="preview-frequency" class="badge" style="font-size: 10px; background: rgba(0,0,0,0.05); padding: 2px 8px; border-radius: var(--radius-sm); text-transform: uppercase; font-weight: 700; margin-top: 4px; display: inline-block;"><?= htmlspecialchars($habit['target_frequency']) ?></span>
              </div>
            </div>
            <div style="position: relative; width: 52px; height: 52px;">
              <svg width="52" height="52" style="transform: rotate(-90deg);">
                <circle cx="26" cy="26" r="22" stroke="rgba(0,0,0,0.05)" stroke-width="4" fill="transparent" />
                <circle id="preview-circle" cx="26" cy="26" r="22" stroke="<?= htmlspecialchars($habit['color']) ?>" stroke-width="4" stroke-linecap="round" fill="transparent" stroke-dasharray="138.23" stroke-dashoffset="138.23" style="transition: var(--transition-base);" />
              </svg>
              <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: var(--color-dark);">
                0%
              </div>
            </div>
          </div>

          <?php if (empty($habit['description'])): ?>
            <p id="preview-description" class="text-muted" style="font-size: var(--font-size-sm); margin-top: var(--space-sm); margin-bottom: 0; opacity: 0.3; font-style: italic;">
              No description provided.
            </p>
          <?php else: ?>
            <p id="preview-description" class="text-muted" style="font-size: var(--font-size-sm); margin-top: var(--space-sm); margin-bottom: 0;">
              <?= htmlspecialchars($habit['description']) ?>
            </p>
          <?php endif; ?>

        </div>
      </div>

      <!-- Edit Form Column (Left on desktop) -->
      <div class="form-column" style="width: 100%;">
        <div class="glass-card">
          <form action="process.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="habit_id" value="<?= htmlspecialchars($habit['habit_id']) ?>">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">

            <div class="form-group">
              <label class="form-label" for="habit_name">Habit Name <span style="color: var(--color-danger);">*</span></label>
              <input type="text" id="habit_name" name="habit_name" class="input-field" 
                     value="<?= htmlspecialchars($habit['habit_name']) ?>" required maxlength="100" autofocus>
            </div>

            <div class="form-group">
              <label class="form-label" for="description">Description</label>
              <input type="text" id="description" name="description" class="input-field" 
                     value="<?= htmlspecialchars($habit['description'] ?? '') ?>" placeholder="e.g. Before bed, no screens" maxlength="255">
            </div>

            <div class="form-group">
              <label class="form-label" for="target_frequency">Target Frequency</label>
              <select id="target_frequency" name="target_frequency" class="input-field" style="background-color: var(--color-bg-secondary);">
                <option value="daily" <?= $habit['target_frequency'] === 'daily' ? 'selected' : '' ?>>Daily</option>
                <option value="weekly" <?= $habit['target_frequency'] === 'weekly' ? 'selected' : '' ?>>Weekly</option>
                <option value="monthly" <?= $habit['target_frequency'] === 'monthly' ? 'selected' : '' ?>>Monthly</option>
              </select>
            </div>

            <!-- Color & Icon Grids -->
            <div style="display: flex; flex-direction: column; gap: var(--space-md); margin-bottom: var(--space-md);">
              
              <div class="form-group" style="margin-bottom: 0;">
                <div class="form-label">Theme Color</div>
                <input type="hidden" id="color" name="color" value="<?= htmlspecialchars($habit['color']) ?>">
                <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 8px;">
                  <?php
                  $swatches = [
                      '#06b6d4' => 'Cyan',
                      '#10b981' => 'Emerald',
                      '#8b5cf6' => 'Violet',
                      '#f43f5e' => 'Rose',
                      '#f59e0b' => 'Gold',
                      '#f97316' => 'Orange'
                  ];
                  foreach ($swatches as $hex => $name): ?>
                    <button type="button" class="color-swatch" data-color="<?= $hex ?>" 
                            style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid transparent; background-color: <?= $hex ?>; cursor: pointer; transition: var(--transition-fast);"
                            title="<?= $name ?>"></button>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="form-group" style="margin-bottom: 0;">
                <div class="form-label">Icon</div>
                <input type="hidden" id="icon" name="icon" value="<?= htmlspecialchars($habit['icon']) ?>">
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(44px, 1fr)); gap: 8px; margin-top: 8px;">
                  <?php
                  $icons = [
                      'star' => 'Star',
                      'heart' => 'Heart',
                      'book' => 'Book',
                      'dumbbell' => 'Dumbbell',
                      'flame' => 'Flame',
                      'target' => 'Target',
                      'smile' => 'Smile',
                      'coffee' => 'Coffee',
                      'droplet' => 'Water',
                      'bike' => 'Bike',
                      'trophy' => 'Trophy',
                      'music' => 'Music'
                  ];
                  foreach ($icons as $name => $label): ?>
                    <button type="button" class="icon-swatch" data-icon="<?= $name ?>" 
                            style="height: 44px; border-radius: var(--radius-md); border: 2px solid transparent; background: rgba(0,0,0,0.05); color: var(--color-dark); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: var(--transition-fast);"
                            title="<?= $label ?>">
                      <i data-lucide="<?= $name ?>" style="width: 20px; height: 20px;"></i>
                    </button>
                  <?php endforeach; ?>
                </div>
              </div>

            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: var(--space-md);">
              <i data-lucide="save"></i> Save Changes
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const nameInput = document.getElementById('habit_name');
    const descInput = document.getElementById('description');
    const freqSelect = document.getElementById('target_frequency');
    const iconInput = document.getElementById('icon');
    const colorInput = document.getElementById('color');

    function updatePreview() {
        // Update Name
        document.getElementById('preview-name').textContent = nameInput.value.trim() || 'New Habit';
        
        // Update Description
        const descVal = descInput.value.trim();
        const descEl = document.getElementById('preview-description');
        if (descVal) {
            descEl.textContent = descVal;
            descEl.style.opacity = '1';
            descEl.style.fontStyle = 'normal';
        } else {
            descEl.textContent = 'No description provided.';
            descEl.style.opacity = '0.3';
            descEl.style.fontStyle = 'italic';
        }

        // Update Frequency
        document.getElementById('preview-frequency').textContent = freqSelect.value;
        
        // Update Icon and Colors
        const activeColor = colorInput.value;
        const activeIcon = iconInput.value;
        
        const iconBg = document.getElementById('preview-icon-bg');
        iconBg.style.background = `${activeColor}20`;
        iconBg.style.color = activeColor;
        
        const previewCard = document.getElementById('habit-preview-card');
        previewCard.style.borderLeftColor = activeColor;
        
        const previewCircle = document.getElementById('preview-circle');
        previewCircle.setAttribute('stroke', activeColor);
        
        const iconEl = document.getElementById('preview-icon');
        iconEl.setAttribute('data-lucide', activeIcon);
        
        // Re-render Lucide icons
        lucide.createIcons();
    }

    nameInput.addEventListener('input', updatePreview);
    descInput.addEventListener('input', updatePreview);
    freqSelect.addEventListener('change', updatePreview);

    // Setup color swatch interactions
    const swatches = document.querySelectorAll('.color-swatch');
    swatches.forEach(swatch => {
        swatch.addEventListener('click', () => {
            swatches.forEach(s => {
                s.style.borderColor = 'transparent';
                s.style.transform = 'none';
            });
            
            swatch.style.borderColor = 'var(--color-dark)';
            swatch.style.transform = 'scale(1.15)';
            colorInput.value = swatch.getAttribute('data-color');
            updatePreview();
        });
    });

    // Setup icon swatch interactions
    const iconSwatches = document.querySelectorAll('.icon-swatch');
    iconSwatches.forEach(iSwatch => {
        iSwatch.addEventListener('click', () => {
            iconSwatches.forEach(i => {
                i.style.borderColor = 'transparent';
                i.style.transform = 'none';
                i.style.background = 'rgba(0,0,0,0.05)';
            });
            
            iSwatch.style.borderColor = 'var(--color-dark)';
            iSwatch.style.transform = 'scale(1.1)';
            iSwatch.style.background = 'rgba(0,0,0,0.1)';
            iconInput.value = iSwatch.getAttribute('data-icon');
            updatePreview();
        });
    });

    // Initialize Active Swatch
    const initialColor = colorInput.value;
    const initialSwatch = document.querySelector(`.color-swatch[data-color="${initialColor}"]`);
    if (initialSwatch) {
        initialSwatch.style.borderColor = 'var(--color-dark)';
        initialSwatch.style.transform = 'scale(1.15)';
    }

    // Initialize Active Icon
    const initialIcon = iconInput.value;
    const initialISwatch = document.querySelector(`.icon-swatch[data-icon="${initialIcon}"]`);
    if (initialISwatch) {
        initialISwatch.style.borderColor = 'var(--color-dark)';
        initialISwatch.style.transform = 'scale(1.1)';
        initialISwatch.style.background = 'rgba(0,0,0,0.1)';
    }

    updatePreview();
});
</script>

<?php include '../../shared/footer.php'; ?>
