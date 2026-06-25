/**
 * RoutineFlow — Main JavaScript
 * 
 * ⚠️  This file is managed by the LEADER only.
 * Shared utilities used across all modules.
 */

// ============================================
// TOAST NOTIFICATIONS
// ============================================

function showToast(message, type = 'success', duration = 3000) {
  const container = document.getElementById('toast-container');
  if (!container) return;

  const toast = document.createElement('div');
  toast.className = `toast ${type}`;

  const iconMap = {
    success: 'check-circle',
    error: 'x-circle',
    warning: 'alert-triangle'
  };

  toast.innerHTML = `
    <i data-lucide="${iconMap[type] || 'info'}"></i>
    <span>${message}</span>
  `;

  container.appendChild(toast);
  lucide.createIcons({ nodes: [toast] });

  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(20px)';
    setTimeout(() => toast.remove(), 300);
  }, duration);
}

// ============================================
// CONFIRM DELETE DIALOG
// ============================================

function confirmDelete(message = 'Are you sure you want to delete this record?') {
  return confirm(message);
}

// ============================================
// FORM VALIDATION HELPERS
// ============================================

function validateRequired(field, label) {
  if (!field.value.trim()) {
    field.classList.add('input-error');
    showToast(`${label} is required`, 'error');
    field.focus();
    return false;
  }
  field.classList.remove('input-error');
  return true;
}

function validateNumber(field, label, min = 0) {
  const val = parseFloat(field.value);
  if (isNaN(val) || val < min) {
    field.classList.add('input-error');
    showToast(`${label} must be a valid number (min: ${min})`, 'error');
    field.focus();
    return false;
  }
  field.classList.remove('input-error');
  return true;
}

// ============================================
// AJAX HELPER
// ============================================

async function ajaxRequest(url, data = {}) {
  try {
    const response = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
    return await response.json();
  } catch (error) {
    console.error('AJAX Error:', error);
    showToast('Something went wrong. Please try again.', 'error');
    return { success: false, error: error.message };
  }
}

// ============================================
// AJAX DELETE (shared across modules)
// ============================================

async function ajaxDelete(url, id, elementId) {
  if (!confirmDelete()) return;

  const result = await ajaxRequest(url, { action: 'delete', id: id });

  if (result.success) {
    const element = document.getElementById(elementId);
    if (element) {
      element.style.opacity = '0';
      element.style.transform = 'scale(0.95)';
      setTimeout(() => element.remove(), 300);
    }
    showToast('Record deleted successfully', 'success');

    // Check if no records left
    setTimeout(() => {
      const container = document.querySelector('.records-grid, .records-list');
      if (container && container.children.length === 0) {
        container.innerHTML = `
          <div class="empty-state glass-card" style="grid-column: 1/-1;">
            <i data-lucide="inbox"></i>
            <p>No records yet. Add your first one!</p>
          </div>
        `;
        lucide.createIcons();
      }
    }, 350);
  } else {
    showToast(result.error || 'Failed to delete record', 'error');
  }
}

// ============================================
// AUTO-DISMISS FLASH MESSAGES
// ============================================

document.addEventListener('DOMContentLoaded', () => {
  // Auto-hide alerts after 4 seconds
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.opacity = '0';
      alert.style.transform = 'translateY(-10px)';
      setTimeout(() => alert.remove(), 300);
    }, 4000);
  });

  // Re-initialize Lucide icons (for dynamically added content)
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
});

// ============================================
// CHART.JS DARK THEME DEFAULTS
// ============================================

if (typeof Chart !== 'undefined') {
  Chart.defaults.color = '#94a3b8';
  Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.06)';
  Chart.defaults.font.family = "'Inter', sans-serif";
}
