<?php
/**
 * RoutineFlow — Sidebar Navigation
 * 
 * iOS-style sidebar with icon-only nav items.
 * Automatically highlights the active page.
 * 
 * READ plan.md for design system details.
 */

// Determine active page for highlighting
$current_page = basename(dirname($_SERVER['REQUEST_URI']));
?>

<!-- Sidebar Navigation -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <i data-lucide="hexagon" class="logo-icon"></i>
        </div>
    </div>
    
    <div class="sidebar-nav">
        <a href="/serverside/dashboard/index.php" 
           class="nav-item <?= $current_page === 'dashboard' ? 'active' : '' ?>" 
           title="Dashboard">
            <i data-lucide="layout-dashboard"></i>
            <span class="nav-label">Dashboard</span>
        </a>
        
        <a href="/serverside/modules/exercise/index.php" 
           class="nav-item <?= $current_page === 'exercise' ? 'active' : '' ?>" 
           title="Exercise">
            <i data-lucide="dumbbell"></i>
            <span class="nav-label">Exercise</span>
        </a>
        
        <a href="/serverside/modules/diary/index.php" 
           class="nav-item <?= $current_page === 'diary' ? 'active' : '' ?>" 
           title="Diary">
            <i data-lucide="book-heart"></i>
            <span class="nav-label">Diary</span>
        </a>
        
        <a href="/serverside/modules/money/index.php" 
           class="nav-item <?= $current_page === 'money' ? 'active' : '' ?>" 
           title="Money">
            <i data-lucide="wallet"></i>
            <span class="nav-label">Money</span>
        </a>
        
        <a href="/serverside/modules/habits/index.php" 
           class="nav-item <?= $current_page === 'habits' ? 'active' : '' ?>" 
           title="Habits">
            <i data-lucide="target"></i>
            <span class="nav-label">Habits</span>
        </a>
    </div>
    
    <div class="sidebar-footer">
        <?php if (is_admin()): ?>
        <a href="/serverside/admin/index.php" 
           class="nav-item <?= $current_page === 'admin' ? 'active' : '' ?>" 
           title="Admin">
            <i data-lucide="shield"></i>
            <span class="nav-label">Admin</span>
        </a>
        <?php endif; ?>
        
        <div class="nav-item user-info" title="<?= htmlspecialchars(get_username()) ?>">
            <i data-lucide="user"></i>
            <span class="nav-label"><?= htmlspecialchars(get_username()) ?></span>
        </div>
        
        <a href="/serverside/auth/logout.php" class="nav-item nav-logout" title="Logout">
            <i data-lucide="log-out"></i>
            <span class="nav-label">Logout</span>
        </a>
    </div>
</nav>

<!-- Instagram-style floating bottom nav (mobile + tablet) -->
<div class="mobile-nav-wrapper" id="mobileNav">
    <nav class="mobile-nav-pill">
        <a href="/serverside/dashboard/index.php" 
           class="pill-nav-item <?= $current_page === 'dashboard' ? 'active' : '' ?>" 
           title="Dashboard">
            <i data-lucide="layout-dashboard"></i>
            <span class="pill-dot"></span>
        </a>
        <a href="/serverside/modules/exercise/index.php" 
           class="pill-nav-item <?= $current_page === 'exercise' ? 'active' : '' ?>" 
           title="Exercise">
            <i data-lucide="dumbbell"></i>
            <span class="pill-dot"></span>
        </a>
        <a href="/serverside/modules/diary/index.php" 
           class="pill-nav-item <?= $current_page === 'diary' ? 'active' : '' ?>" 
           title="Diary">
            <i data-lucide="book-heart"></i>
            <span class="pill-dot"></span>
        </a>
        <a href="/serverside/modules/money/index.php" 
           class="pill-nav-item <?= $current_page === 'money' ? 'active' : '' ?>" 
           title="Money">
            <i data-lucide="wallet"></i>
            <span class="pill-dot"></span>
        </a>
        <a href="/serverside/modules/habits/index.php" 
           class="pill-nav-item <?= $current_page === 'habits' ? 'active' : '' ?>" 
           title="Habits">
            <i data-lucide="target"></i>
            <span class="pill-dot"></span>
        </a>
    </nav>
</div>
