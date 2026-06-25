# 🎯 RoutineFlow

A premium, glassmorphism-styled web application designed to serve as a personal command center for students. Manage your habits, finances, exercise, and diary entries in one unified, iOS-inspired dashboard.

## 🚀 Features
- **Spatial Light UI**: Heavy backdrop-blurs, glass panels, neon green accents.
- **Modules**:
  - 🏋️ **Exercise Tracker**: Log and monitor your workouts.
  - 📖 **Diary Journal**: Personal thoughts and reflections.
  - 💰 **Money Tracker**: Manage income and expenses.
  - 🎯 **Habit Tracker**: Build positive daily routines.

## 🛠️ Setup Instructions
1. Clone the repository into your XAMPP `htdocs` directory:
   ```bash
   git clone https://github.com/Kendrew1119/RoutineFlow.git serverside
   ```
2. Start Apache and MySQL from the XAMPP control panel.
3. Import `database/schema.sql` via phpMyAdmin to setup the database.
4. Create a `.env` file in the root directory and configure your database credentials (see `.env.example` if applicable, or set `DB_USER=root` with a blank password for standard XAMPP).
5. Open your browser and navigate to `http://localhost/serverside/`.

## 👥 Team
- **Kendrew (Leader)**: Dashboard, Auth, Diary, Shared UI, Architecture
- **Member B**: Exercise Tracker
- **Member C**: Money Tracker
- **Member D**: Habit Tracker

*Developed for UCCD3243 Server-Side Web Applications Development.*
