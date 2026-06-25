# 🎯 Student Routine Organizer — Project Master Plan

> **Course:** UCCD3243 Server-Side Web Applications Development  
> **Trimester:** June 2026  
> **Deadline:** 24 August 2026 (Monday), 5:00 PM  
> **Team Size:** 4 Members  
> **Weight:** 15% of overall assessment (100 marks)

---

## 📌 Table of Contents

1. [Project Idea & Vision](#-project-idea--vision)
2. [Tech Stack](#-tech-stack)
3. [Design System — Glassmorphism iOS Theme](#-design-system--glassmorphism-ios-theme)
4. [Color Theme Options](#-color-theme-options)
5. [Folder Structure](#-folder-structure)
6. [Team Role & Module Assignment](#-team-role--module-assignment)
7. [14-Week Schedule](#-14-week-schedule)
8. [Report Task Distribution](#-report-task-distribution)
9. [Database Design Overview](#-database-design-overview)
10. [Shared Authentication Flow](#-shared-authentication-flow)
11. [AI Agent Prompt — Design & Integration Guide](#-ai-agent-prompt--design--integration-guide)
12. [API & Library Setup Guide](#-api--library-setup-guide)
13. [Deliverables Checklist](#-deliverables-checklist)

---

## 💡 Project Idea & Vision

### Concept: **"RoutineFlow"**

A premium, glassmorphism-styled web app that helps students take control of their daily lives. Unlike typical CRUD apps, RoutineFlow feels like a **personal command center** — a sleek, iOS-inspired dashboard where students can track workouts, journal their thoughts, manage finances, and build positive habits, all in one unified experience.

### What Makes It Innovative

| Innovation | Description |
|---|---|
| **🎨 Glassmorphism UI** | Frosted-glass cards, smooth blur effects, and floating elements — feels like a native iOS/macOS app running in the browser |
| **📊 Data Visualization** | Chart.js-powered graphs for exercise stats, spending trends, habit streaks, and mood patterns |
| **🔄 AJAX Real-Time** | Add/edit/delete records without page reloads — smooth, instant feedback |
| **🌤️ Weather Widget** | OpenWeatherMap API on the dashboard — contextual data (e.g., "Great weather for jogging!") |
| **💬 Motivational Quotes** | API-powered daily quotes on the diary page to inspire journaling |
| **🏆 Gamification** | Streak counters, progress rings, and achievement badges for habit tracking |
| **📱 Responsive Design** | Works beautifully on desktop, tablet, and mobile |
| **🌙 Dark Mode Default** | Dark-first design with optional light mode toggle |
| **🔐 Role-Based Access** | Student vs Admin dashboards with different capabilities |
| **📤 Export Feature** | Export records to CSV for personal use |

---

## 🔧 Tech Stack

### Required (Course Mandate)

| Layer | Technology | Purpose |
|---|---|---|
| **Server** | XAMPP (Apache + PHP 8.x) | Local development environment |
| **Backend** | PHP 8.x | Server-side logic, CRUD operations |
| **Database** | MySQL via phpMyAdmin | Relational data storage |
| **Architecture** | 3-Tier (Presentation → Logic → Data) | Separation of concerns |

### Frontend Libraries (CDN — No Installation Required)

| Library | CDN Link | Purpose |
|---|---|---|
| **Inter Font** | `https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap` | Modern, clean typography (iOS-style) |
| **Lucide Icons** | `https://unpkg.com/lucide@latest` | Minimal line icons (replaces text with icons) |
| **Chart.js 4** | `https://cdn.jsdelivr.net/npm/chart.js` | Beautiful charts for data visualization |
| **Animate.css** | `https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css` | Micro-animations for UI polish |

### Optional API Integrations

| API | Free Tier | Purpose |
|---|---|---|
| **OpenWeatherMap** | 1,000 calls/day free | Dashboard weather widget |
| **ZenQuotes API** | Unlimited free | Daily motivational quotes for diary |

### Why This Stack

- ✅ **PHP + MySQL is mandatory** — we maximize marks by mastering the required tools
- ✅ **CDN libraries = zero installation** — just `<link>` and `<script>` tags, no npm/node needed
- ✅ **Chart.js** demonstrates advanced frontend skills (optional feature marks)
- ✅ **AJAX** directly aligns with Week 9 lecture topic — shows you applied course concepts
- ✅ **Weather API** shows real-world API integration — bonus marks for innovation
- ✅ **Glassmorphism CSS** is pure CSS — no framework dependency, shows CSS mastery

---

## 🎨 Design System — Glassmorphism iOS Theme

### Core Design Principles

> **⚠️ ATTENTION TEAM:** Please refer to the Main Dashboard (`dashboard/index.php`) as the ultimate source of truth for our styling and layout. Your module pages must match this look and feel exactly.

```
1. GLASSMORPHISM  → Heavy frosted glass cards with high blur (40px) and lower opacity (0.35).
2. SPATIAL LIGHT  → Light theme, sleek dark accents (#121212), and vibrant Neon Green (#D1F34D).
3. AMSI GROTESK   → Headings and titles use 'Amsi Grotesk Extended' for a wide, premium feel.
4. SPACIOUS       → Generous padding, breathing room between elements.
5. ICON-FIRST     → Use Lucide icons instead of text labels wherever possible.
6. MINIMAL TEXT   → Short labels, no paragraphs on UI — content speaks for itself.
7. ROUNDED        → Extreme border-radius: 24px-32px on cards, 16px on buttons.
8. SMOOTH         → All interactions have transition: all 0.3s ease.
```

### CSS Variables (Design Tokens) — EVERY PAGE MUST USE THESE

```css
:root {
  /* === TYPOGRAPHY === */
  --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  --font-size-xs: 0.75rem;    /* 12px — captions */
  --font-size-sm: 0.875rem;   /* 14px — secondary text */
  --font-size-base: 1rem;     /* 16px — body text */
  --font-size-lg: 1.25rem;    /* 20px — card titles */
  --font-size-xl: 1.5rem;     /* 24px — section headers */
  --font-size-2xl: 2rem;      /* 32px — page titles */
  --font-size-3xl: 2.5rem;    /* 40px — hero text */

  /* === SPACING === */
  --space-xs: 4px;
  --space-sm: 8px;
  --space-md: 16px;
  --space-lg: 24px;
  --space-xl: 32px;
  --space-2xl: 48px;
  --space-3xl: 64px;

  /* === BORDER RADIUS === */
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 24px;
  --radius-full: 9999px;

  /* === GLASSMORPHISM === */
  --glass-bg: rgba(255, 255, 255, 0.08);
  --glass-border: rgba(255, 255, 255, 0.12);
  --glass-blur: blur(20px);
  --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);

  /* === TRANSITIONS === */
  --transition-fast: all 0.15s ease;
  --transition-base: all 0.3s ease;
  --transition-slow: all 0.5s ease;
}
```

### Glassmorphism Card Template

```css
.glass-card {
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-lg);
  box-shadow: var(--glass-shadow);
  padding: var(--space-lg);
  transition: var(--transition-base);
}

.glass-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
  border-color: rgba(255, 255, 255, 0.2);
}
```

### Button Styles

```css
.btn-primary {
  background: var(--color-primary);
  color: white;
  border: none;
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-lg);
  font-family: var(--font-primary);
  font-weight: 600;
  font-size: var(--font-size-sm);
  cursor: pointer;
  transition: var(--transition-base);
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
}

.btn-primary:hover {
  filter: brightness(1.15);
  transform: translateY(-1px);
}

.btn-ghost {
  background: transparent;
  color: var(--color-text-secondary);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-lg);
  cursor: pointer;
  transition: var(--transition-base);
}

.btn-ghost:hover {
  background: var(--glass-bg);
  color: var(--color-text-primary);
}
```

### Input Fields

```css
.input-field {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-md);
  color: var(--color-text-primary);
  font-family: var(--font-primary);
  font-size: var(--font-size-base);
  transition: var(--transition-base);
  width: 100%;
}

.input-field:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb), 0.2);
}
```

---

## 🎨 Color Theme
 
 > **The theme has been locked to "Spatial Light"**
 
 ```css
 :root {
   --color-bg-primary: #f2f2f7;           /* iOS light grey background */
   --color-bg-secondary: #ffffff;
   --color-primary: #D1F34D;              /* Neon green accent */
   --color-dark: #121212;                 /* Dark accent for cards/sidebar */
   --color-success: #34C759;              /* iOS green */
   --color-warning: #FF9F0A;              /* iOS orange */
   --color-danger: #FF3B30;               /* iOS red */
   --color-text-primary: #121212;         /* Dark text on light bg */
   --color-text-secondary: #8E8E93;       /* iOS secondary grey */
 }
 ```
 
 **Vibe:** Modern spatial dashboard UI with heavy backdrop-blurs, neon green accent, dark sidebar, and white glass panels. Feels extremely premium, high-contrast, and clean.

---

## 📁 Folder Structure

```
serverside/
├── plan.md                          ← THIS FILE (read first!)
├── questions/                       ← Assignment docs (do not modify)
│
├── config/                          ← [LEADER] Shared configuration
│   ├── db.php                       ← Database connection (PDO)
│   └── session.php                  ← Session initialization + auth helpers
│
├── shared/                          ← [LEADER] Shared UI components
│   ├── header.php                   ← HTML head, CSS links, opening <body>
│   ├── footer.php                   ← Scripts, closing </body>
│   ├── navbar.php                   ← Sidebar/bottom navigation bar
│   └── auth_check.php               ← Redirect if not logged in
│
├── assets/                          ← [LEADER] Static assets
│   ├── css/
│   │   └── style.css                ← MASTER stylesheet (design system)
│   ├── js/
│   │   └── main.js                  ← Shared JS (navbar toggle, theme, etc.)
│   └── img/
│       └── logo.png                 ← App logo
│
├── auth/                            ← [LEADER] Authentication pages
│   ├── login.php                    ← Login page
│   ├── register.php                 ← Registration page
│   ├── logout.php                   ← Destroy session + redirect
│   └── process_auth.php             ← Handle login/register POST
│
├── dashboard/                       ← [LEADER] Main dashboard
│   └── index.php                    ← Dashboard with summary cards for all modules
│
├── admin/                           ← [LEADER] Admin panel
│   ├── index.php                    ← Admin dashboard (user list, stats)
│   └── manage_users.php             ← View/manage registered users
│
├── modules/                         ← Each member works ONLY in their folder
│   ├── exercise/                    ← [MEMBER B] Exercise Tracker
│   │   ├── index.php                ← List all exercise records
│   │   ├── add.php                  ← Add new exercise form
│   │   ├── edit.php                 ← Edit exercise form
│   │   ├── delete.php               ← Delete handler
│   │   ├── process.php              ← CRUD logic (POST handler)
│   │   └── ajax_handler.php         ← AJAX endpoints for this module
│   │
│   ├── diary/                       ← [MEMBER C] Diary Journal
│   │   ├── index.php
│   │   ├── add.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   ├── process.php
│   │   └── ajax_handler.php
│   │
│   ├── money/                       ← [MEMBER D] Money Tracker
│   │   ├── index.php
│   │   ├── add.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   ├── process.php
│   │   └── ajax_handler.php
│   │
│   └── habits/                      ← [LEADER / MEMBER A] Habit Tracker
│       ├── index.php
│       ├── add.php
│       ├── edit.php
│       ├── delete.php
│       ├── process.php
│       └── ajax_handler.php
│
├── database/                        ← SQL files
│   └── schema.sql                   ← Full database schema (CREATE TABLE statements)
│
└── report/                          ← Report documents
    └── README.md                    ← Report writing guidelines
```

---

## 👥 Team Role & Module Assignment

### Development Responsibilities

| Role | Member | Module | Also Responsible For |
|---|---|---|---|
| **🟢 Leader (Kendrew)** | YOU | **Diary Journal** | Main Page (`dashboard/index.php`), Auth (Login/Register), Shared components, CSS Design System, Database schema |
| **🔵 Member B** | TBD | **Exercise Tracker** | CRUD for exercises, Chart.js graphs for workout stats, sorting/filtering |
| **🟡 Member C** | TBD | **Money Tracker** | CRUD for transactions, income/expense charts, category filters, CSV export |
| **🔴 Member D** | TBD | **Habit Tracker** | CRUD for habits, streak calculation logic, progress ring UI |

### Golden Rules (File Editing Permissions)

1. **Each member works ONLY in their assigned module folder** — do NOT touch other members' folders!
   - Member B: ONLY edits files inside `modules/exercise/`
   - Member C: ONLY edits files inside `modules/money/`
   - Member D: ONLY edits files inside `modules/habits/`
2. **Leader (Kendrew) owns:** `dashboard/`, `auth/`, `modules/diary/`, `config/`, `shared/`, `assets/`, and `admin/`
3. **Integration (navbar links, dashboard summary cards)** is managed by the Leader.
4. **Every module MUST include** these shared files at the top:
   ```php
   <?php
   require_once '../../config/session.php';
   require_once '../../config/db.php';
   require_once '../../shared/auth_check.php';
   ?>
   ```
5. **Every page MUST include** the shared header, navbar, and footer:
   ```php
   <?php include '../../shared/header.php'; ?>
   <?php include '../../shared/navbar.php'; ?>
   
   <!-- YOUR MODULE CONTENT HERE -->
   
   <?php include '../../shared/footer.php'; ?>
   ```

---

## 📅 14-Week Schedule

> Weeks aligned with UTAR teaching plan. **Assignment released Week 2, due Week 11.**

### Phase 1: Foundation (Weeks 1–3) — Leader-Heavy

| Week | Dates | Leader (Member A) | Member B | Member C | Member D |
|---|---|---|---|---|---|
| **1** | 15–21 Jun | Set up XAMPP, create GitHub/shared folder, write `plan.md`, choose color theme | Read plan.md, set up XAMPP | Read plan.md, set up XAMPP | Read plan.md, set up XAMPP |
| **2** | 22–28 Jun | Create `config/db.php`, `config/session.php`, design `schema.sql`, build `style.css` design system | Study PHP basics (Practical 1) | Study PHP basics (Practical 1) | Study PHP basics (Practical 1) |
| **3** | 29 Jun–5 Jul | Build `auth/login.php`, `auth/register.php`, `auth/process_auth.php`, `auth/logout.php` | Study DB + CRUD (Practical 2), start planning exercise module DB fields | Study DB + CRUD, plan diary module DB fields | Study DB + CRUD, plan money module DB fields |

### Phase 2: Core Development (Weeks 4–7) — All Members Active

| Week | Dates | Leader (Member A) | Member B | Member C | Member D |
|---|---|---|---|---|---|
| **4** | 6–12 Jul | Build `shared/navbar.php`, `shared/header.php`, `shared/footer.php`, `dashboard/index.php` skeleton | **Start** `exercise/index.php` (list view) + `exercise/add.php` | **Start** `diary/index.php` (list view) + `diary/add.php` | **Start** `money/index.php` (list view) + `money/add.php` |
| **5** | 13–19 Jul | Build `admin/index.php`, `admin/manage_users.php`. Start `habits/index.php` + `habits/add.php` | Build `exercise/edit.php` + `exercise/delete.php` | Build `diary/edit.php` + `diary/delete.php` | Build `money/edit.php` + `money/delete.php` |
| **6** | 20–26 Jul | Build `habits/edit.php`, `habits/delete.php`. Implement cookies (remember me, theme pref). **Quiz week** | Add sorting/filtering to exercise list. Add cookie for last viewed filter | Add mood selector component. Add cookie for preferred journal view | Add category filter + income/expense toggle. Add cookie for default category |
| **7** | 27 Jul–2 Aug | Build `habits/process.php` — streak calculation logic, progress ring UI | Polish exercise UI, add Chart.js workout stats graph | Polish diary UI, integrate ZenQuotes API for daily quote | Polish money UI, add Chart.js spending/income pie chart |

### Phase 3: Advanced Features & AJAX (Weeks 8–9)

| Week | Dates | Leader (Member A) | Member B | Member C | Member D |
|---|---|---|---|---|---|
| **8** | 3–9 Aug | Integrate dashboard summary cards (pull stats from all modules). **Midterm week** | `exercise/ajax_handler.php` — AJAX delete without page reload | `diary/ajax_handler.php` — AJAX search journal entries | `money/ajax_handler.php` — AJAX filter by date range |
| **9** | 10–16 Aug | `habits/ajax_handler.php` — AJAX mark habit complete. Add weather widget to dashboard (OpenWeatherMap API) | Add error handling + input validation to all exercise forms | Add error handling + input validation to all diary forms | Add error handling + input validation to all money forms. Add CSV export |

### Phase 4: Integration, Testing & Polish (Weeks 10–11)

| Week | Dates | Leader (Member A) | Member B | Member C | Member D |
|---|---|---|---|---|---|
| **10** | 17–23 Aug | **Integration sprint:** connect all module stats to dashboard, test all navbar links, fix cross-module bugs, security hardening (XSS, SQL injection prevention) | Final testing of exercise module, fix bugs, ensure all CRUD works | Final testing of diary module, fix bugs, ensure all CRUD works | Final testing of money module, fix bugs, ensure all CRUD works |
| **11** | **24–30 Aug** | **🚨 SUBMISSION DAY (24 Aug):** Final integration test, export database to `.sql`, zip everything, submit via Google Form | Help with integration testing | Help with integration testing | Help with integration testing |

### Phase 5: Report & Exam Prep (Weeks 11–14)

| Week | Dates | All Members |
|---|---|---|
| **11** | 24–30 Aug | Begin report writing (see Report Task Distribution below) |
| **12** | 31 Aug–6 Sep | Complete report draft. Practical Test prep (2 Sep). Peer review report |
| **13** | 7–13 Sep | Finalize report, format to IEEE, proofread. Revision for final exam |
| **14** | 14–20 Sep | Final exam revision |

---

## 📝 Report Task Distribution

> Report must not exceed 30 pages. IEEE referencing format.

| Report Section | Assigned To | Page Estimate | Details |
|---|---|---|---|
| **Title Page + Marking Scheme** | Leader | 1 page | Cover page with unit code, course, names, practical group |
| **Site Hierarchy & Navigation** | Leader | 2–3 pages | Site map diagram + explanation of page flow across all modules |
| **Overview of Database Structure** | Leader | 2–3 pages | ER diagram / schema diagram + explanation of table relationships |
| **System Flowchart — Habit Tracker** | Leader | 2–3 pages | Flowchart for habit module CRUD + explanation |
| **Functional Requirements — Habit Tracker** | Leader | 2–3 pages | Feature list + descriptions for habit module |
| **System Flowchart — Exercise Tracker** | Member B | 2–3 pages | Flowchart for exercise module CRUD + explanation |
| **Functional Requirements — Exercise Tracker** | Member B | 2–3 pages | Feature list + descriptions for exercise module |
| **System Flowchart — Diary Journal** | Member C | 2–3 pages | Flowchart for diary module CRUD + explanation |
| **Functional Requirements — Diary Journal** | Member C | 2–3 pages | Feature list + descriptions for diary module |
| **System Flowchart — Money Tracker** | Member D | 2–3 pages | Flowchart for money module CRUD + explanation |
| **Functional Requirements — Money Tracker** | Member D | 2–3 pages | Feature list + descriptions for money module |
| **References (IEEE)** | All | 1 page | Each member adds references for their module |

---

## 🗄️ Database Design Overview

### Tables

```sql
-- ============================================
-- DATABASE: routineflow_db
-- ============================================

-- 1. USERS TABLE (Leader manages)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,          -- password_hash()
    role ENUM('student', 'admin') DEFAULT 'student',
    profile_pic VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. EXERCISE RECORDS (Member B)
CREATE TABLE exercises (
    exercise_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    activity_type VARCHAR(50) NOT NULL,      -- jogging, cycling, gym, swimming, etc.
    duration_minutes INT NOT NULL,
    calories_burned INT DEFAULT 0,
    intensity ENUM('low', 'medium', 'high') DEFAULT 'medium',
    notes TEXT,
    exercise_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- 3. DIARY ENTRIES (Member C)
CREATE TABLE diary_entries (
    entry_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    mood ENUM('happy', 'excited', 'neutral', 'sad', 'angry', 'anxious') NOT NULL,
    tags VARCHAR(255),                       -- comma-separated tags
    entry_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- 4. FINANCIAL RECORDS (Member D)
CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    category VARCHAR(50) NOT NULL,           -- food, transport, entertainment, salary, etc.
    description VARCHAR(255),
    transaction_type ENUM('income', 'expense') NOT NULL,
    transaction_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- 5. HABITS (Leader / Member A)
CREATE TABLE habits (
    habit_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    habit_name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    target_frequency ENUM('daily', 'weekly', 'monthly') DEFAULT 'daily',
    color VARCHAR(7) DEFAULT '#06b6d4',      -- hex color for UI display
    icon VARCHAR(50) DEFAULT 'star',         -- lucide icon name
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- 6. HABIT COMPLETIONS (Leader / Member A) — tracks daily completion
CREATE TABLE habit_completions (
    completion_id INT AUTO_INCREMENT PRIMARY KEY,
    habit_id INT NOT NULL,
    user_id INT NOT NULL,
    completion_date DATE NOT NULL,
    status ENUM('completed', 'missed') DEFAULT 'completed',
    notes VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (habit_id) REFERENCES habits(habit_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_habit_date (habit_id, completion_date)
);
```

### Relationships

```
users (1) ──→ (∞) exercises       — A user has many exercise records
users (1) ──→ (∞) diary_entries   — A user has many journal entries
users (1) ──→ (∞) transactions    — A user has many financial records
users (1) ──→ (∞) habits          — A user has many habits
habits (1) ──→ (∞) habit_completions — A habit has many completion records
```

---

## 🔐 Shared Authentication Flow

### How Login Connects All Modules

```
┌──────────────┐     POST      ┌───────────────────┐
│  login.php   │ ────────────→ │ process_auth.php  │
│  (form)      │               │ (validate + hash) │
└──────────────┘               └────────┬──────────┘
                                        │
                               ┌────────▼──────────┐
                               │  $_SESSION set:    │
                               │  user_id           │
                               │  username          │
                               │  role              │
                               └────────┬──────────┘
                                        │
                          ┌─────────────┼─────────────┐
                          │             │             │
                   role='student'       │      role='admin'
                          │             │             │
                ┌─────────▼──────┐      │    ┌────────▼────────┐
                │ dashboard/     │      │    │ admin/          │
                │ index.php      │      │    │ index.php       │
                └────────────────┘      │    └─────────────────┘
                                        │
                    Navbar links to all 4 modules:
                    /modules/exercise/index.php
                    /modules/diary/index.php
                    /modules/money/index.php
                    /modules/habits/index.php
```

### Session Variables Available in Every Page

After login, every module can access:

```php
$_SESSION['user_id']    // INT — use in all SQL queries: WHERE user_id = ?
$_SESSION['username']   // STRING — display in navbar greeting
$_SESSION['role']       // 'student' or 'admin' — for access control
```

### How Each Module Connects

Every module page starts with:

```php
<?php
// STEP 1: Start session + load config
require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';  // Redirects to login if not authenticated

// STEP 2: Get current user
$user_id = $_SESSION['user_id'];

// STEP 3: Your module logic here...
// All queries MUST filter by user_id:
// $stmt = $pdo->prepare("SELECT * FROM exercises WHERE user_id = ? ORDER BY exercise_date DESC");
// $stmt->execute([$user_id]);
?>

<?php include '../../shared/header.php'; ?>
<?php include '../../shared/navbar.php'; ?>

<!-- STEP 4: Your module HTML here -->

<?php include '../../shared/footer.php'; ?>
```

---

## 🤖 AI Agent Prompt — Design & Integration Guide

> **⚠️ IMPORTANT: All team members using AI agents to write code MUST paste this section as context.**

### For AI Agents: Project Context

```
PROJECT NAME: RoutineFlow — Student Routine Organizer
TECH STACK: PHP 8.x + MySQL + XAMPP + Vanilla CSS + Vanilla JS
ARCHITECTURE: 3-tier (Presentation → Logic → Data)
UI STYLE: Glassmorphism, iOS-inspired, dark mode, spacious, icon-heavy

YOU ARE BUILDING A MODULE FOR THIS PROJECT. Follow these rules EXACTLY:
```

### Rule 1: File Structure

```
Your module lives in: serverside/modules/<your_module>/
You have these files:
  - index.php      → List all records (READ)
  - add.php        → Form to create new record (CREATE)
  - edit.php       → Form to edit existing record (UPDATE)
  - delete.php     → Delete handler (DELETE)
  - process.php    → Handles all form POST submissions
  - ajax_handler.php → AJAX endpoints (search, filter, delete without reload)
```

### Rule 2: Required Includes (Top of EVERY PHP file)

```php
<?php
require_once '../../config/session.php';
require_once '../../config/db.php';
require_once '../../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
?>
<?php include '../../shared/header.php'; ?>
<?php include '../../shared/navbar.php'; ?>

<!-- YOUR CONTENT INSIDE <main class="main-content"> -->
<main class="main-content">
  <div class="page-container">
    <!-- Module content here -->
  </div>
</main>

<?php include '../../shared/footer.php'; ?>
```

### Rule 3: CSS Classes to Use (DO NOT write custom CSS — use these)

```
Layout:      .main-content, .page-container
Cards:       .glass-card, .glass-card-hover
Buttons:     .btn-primary, .btn-ghost, .btn-danger, .btn-sm
Forms:       .input-field, .form-group, .form-label
Text:        .text-primary, .text-secondary, .text-muted, .text-gradient
Grid:        .grid-2, .grid-3, .grid-4 (responsive grid layouts)
Spacing:     .mt-sm, .mt-md, .mt-lg, .mb-sm, .mb-md, .mb-lg
Flex:        .flex, .flex-between, .flex-center, .flex-col, .gap-sm, .gap-md
Alerts:      .alert-success, .alert-error, .alert-warning
Tables:      .data-table (glassmorphism styled table)
Badges:      .badge, .badge-success, .badge-warning, .badge-danger
Icons:        Use <i data-lucide="icon-name"></i> — see https://lucide.dev/icons
```

### Rule 4: Database Queries (PDO Only)

```php
// ALWAYS use prepared statements
$stmt = $pdo->prepare("SELECT * FROM your_table WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// INSERT
$stmt = $pdo->prepare("INSERT INTO your_table (user_id, field1, field2) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $field1, $field2]);

// UPDATE
$stmt = $pdo->prepare("UPDATE your_table SET field1 = ?, field2 = ? WHERE id = ? AND user_id = ?");
$stmt->execute([$field1, $field2, $id, $user_id]);

// DELETE
$stmt = $pdo->prepare("DELETE FROM your_table WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
```

### Rule 5: Page Layout Pattern

```
Every list page (index.php) follows this layout:

┌─────────────────────────────────────────────────┐
│  [Icon] Module Title              [+ Add] btn   │  ← Page header
├─────────────────────────────────────────────────┤
│  [Search input]  [Filter dropdown]  [Sort btn]  │  ← Toolbar (optional)
├─────────────────────────────────────────────────┤
│  ┌──────────┐  ┌──────────┐  ┌──────────┐      │
│  │ glass    │  │ glass    │  │ glass    │      │  ← Records as cards
│  │ card     │  │ card     │  │ card     │      │     (grid layout)
│  │ [✏️][🗑️] │  │ [✏️][🗑️] │  │ [✏️][🗑️] │      │
│  └──────────┘  └──────────┘  └──────────┘      │
│                                                 │
│  ┌──────────┐  ┌──────────┐                     │
│  │ glass    │  │ glass    │                     │
│  │ card     │  │ card     │                     │
│  └──────────┘  └──────────┘                     │
└─────────────────────────────────────────────────┘

Every form page (add.php / edit.php) follows this layout:

┌─────────────────────────────────────────────────┐
│  [←] Back to List          Module Title         │  ← Header with back btn
├─────────────────────────────────────────────────┤
│  ┌─────────────────────────────────────────┐    │
│  │ glass-card form                         │    │  ← Single centered card
│  │                                         │    │
│  │  Label                                  │    │
│  │  [___input field___________________]    │    │
│  │                                         │    │
│  │  Label                                  │    │
│  │  [___input field___________________]    │    │
│  │                                         │    │
│  │  Label                                  │    │
│  │  [___textarea______________________]    │    │
│  │                                         │    │
│  │  [Cancel]  [Save Record]               │    │  ← Action buttons
│  └─────────────────────────────────────────┘    │
└─────────────────────────────────────────────────┘
```

### Rule 6: AJAX Pattern

```javascript
// Use Fetch API for AJAX calls
async function deleteRecord(id) {
  if (!confirm('Are you sure?')) return;
  
  try {
    const response = await fetch('ajax_handler.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'delete', id: id })
    });
    const data = await response.json();
    
    if (data.success) {
      document.getElementById(`record-${id}`).remove();
      showToast('Record deleted successfully', 'success');
    }
  } catch (error) {
    showToast('Something went wrong', 'error');
  }
}
```

### Rule 7: Error Handling

```php
// Validate ALL inputs server-side
if (empty($_POST['field_name'])) {
    $_SESSION['error'] = 'Field name is required.';
    header('Location: add.php');
    exit;
}

// Display errors/success messages
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-error">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
}
```

### Rule 8: Security

```php
// ALL output must be escaped
echo htmlspecialchars($variable, ENT_QUOTES, 'UTF-8');

// ALL queries must use prepared statements (see Rule 4)
// NEVER concatenate user input into SQL strings

// CSRF protection: include token in forms
// The shared header.php generates $_SESSION['csrf_token']
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
```

---

## 📦 API & Library Setup Guide

### 1. XAMPP Setup

```
1. Download XAMPP from https://www.apachefriends.org/
2. Install with default settings
3. Place this entire project folder inside: C:\xampp\htdocs\serverside\
4. Start Apache and MySQL from XAMPP Control Panel
5. Access the app at: http://localhost/serverside/
6. Access phpMyAdmin at: http://localhost/phpmyadmin/
```

### 2. Database Setup

```
1. Open phpMyAdmin (http://localhost/phpmyadmin/)
2. Create a new database: routineflow_db
3. Import the file: database/schema.sql
4. Or manually run the CREATE TABLE statements from the Database Design section above
```

### 3. Chart.js (CDN — No Install)

Already included in `shared/header.php`. Use in your module like:

```html
<canvas id="myChart" width="400" height="200"></canvas>
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut', // or 'bar', 'line', 'pie'
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
      datasets: [{
        data: [12, 19, 3, 5, 2],
        backgroundColor: [
          'rgba(6, 182, 212, 0.8)',   // cyan
          'rgba(139, 92, 246, 0.8)',  // purple
          'rgba(16, 185, 129, 0.8)',  // green
          'rgba(245, 158, 11, 0.8)', // amber
          'rgba(239, 68, 68, 0.8)'   // red
        ]
      }]
    },
    options: {
      plugins: {
        legend: { labels: { color: '#f1f5f9' } }
      }
    }
  });
</script>
```

### 4. Lucide Icons (CDN — No Install)

Already included in `shared/footer.php`. Use like:

```html
<!-- Just add the icon element, it auto-renders -->
<i data-lucide="home"></i>          <!-- Home icon -->
<i data-lucide="dumbbell"></i>      <!-- Exercise -->
<i data-lucide="book-heart"></i>    <!-- Diary -->
<i data-lucide="wallet"></i>        <!-- Money -->
<i data-lucide="target"></i>        <!-- Habits -->
<i data-lucide="plus"></i>          <!-- Add -->
<i data-lucide="pencil"></i>        <!-- Edit -->
<i data-lucide="trash-2"></i>       <!-- Delete -->
<i data-lucide="search"></i>        <!-- Search -->
<i data-lucide="filter"></i>        <!-- Filter -->
<i data-lucide="log-out"></i>       <!-- Logout -->
<i data-lucide="user"></i>          <!-- Profile -->
<i data-lucide="sun"></i>           <!-- Light mode -->
<i data-lucide="moon"></i>          <!-- Dark mode -->

<!-- Icon with size -->
<i data-lucide="home" style="width:20px; height:20px;"></i>

<!-- Browse all icons: https://lucide.dev/icons -->
```

### 5. OpenWeatherMap API (Optional — Dashboard Widget)

```
1. Register at https://openweathermap.org/api
2. Get your free API key (1,000 calls/day)
3. Add your key to config/db.php:
   define('WEATHER_API_KEY', 'your_api_key_here');
4. Use in dashboard:
```

```javascript
async function getWeather() {
  const API_KEY = '<?= WEATHER_API_KEY ?>';
  const response = await fetch(
    `https://api.openweathermap.org/data/2.5/weather?q=Kuala+Lumpur&appid=${API_KEY}&units=metric`
  );
  const data = await response.json();
  document.getElementById('weather-temp').textContent = `${Math.round(data.main.temp)}°C`;
  document.getElementById('weather-desc').textContent = data.weather[0].description;
}
```

### 6. ZenQuotes API (Optional — Diary Module)

```javascript
// Free, no API key needed
async function getDailyQuote() {
  const response = await fetch('https://zenquotes.io/api/random');
  const data = await response.json();
  document.getElementById('daily-quote').textContent = `"${data[0].q}" — ${data[0].a}`;
}
```

---

## ✅ Deliverables Checklist

### Code Submission (Zip File)

- [ ] All PHP source files organized in folder structure
- [ ] `database/schema.sql` — importable SQL file with latest schema + sample data
- [ ] All CSS/JS/image assets in `assets/` folder
- [ ] No vendor folders, no `.git` folder, no IDE config files in the zip

### Report (PDF)

- [ ] Title page with unit code, course, all names, practical group, marking scheme
- [ ] Site hierarchy diagram + navigation explanation
- [ ] System flowcharts for each module (4 total, one per member)
- [ ] Database ER diagram + explanation of relationships
- [ ] Functional requirements for each module (4 total, one per member)
- [ ] IEEE referencing format
- [ ] Total ≤ 30 pages (excluding cover and references)

### Submission

- [ ] Upload report via Google Form: https://forms.gle/6h4cQwyUtjcXzatH6
- [ ] Include Google Drive link (publicly accessible) with all materials
- [ ] Only ONE submission per group (Leader submits)
- [ ] Submitted by **24 August 2026, 5:00 PM**

---

## ❓ Questions for Team

1. **Which color theme do you prefer?** Option A (Midnight Ocean), B (Soft Blossom), or C (Forest Mint)?
2. **Member B, C, D — confirm your module assignment.** Any swaps needed?
3. **Does everyone have XAMPP installed and working?**
4. **Shall we create a shared Google Drive folder or use GitHub for collaboration?**

---

> **📖 Last updated:** 22 June 2026  
> **✍️ Written by:** Leader (Member A)  
> **📌 Next step:** Leader to finalize color theme → build `config/`, `shared/`, `assets/`, `auth/` → Members start their modules in Week 4
