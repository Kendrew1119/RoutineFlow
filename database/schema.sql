-- ============================================
-- RoutineFlow — Database Schema
-- UCCD3243 Server-Side Web Applications Development
-- 
-- HOW TO USE:
-- 1. Open phpMyAdmin (http://localhost/phpmyadmin/)
-- 2. Create a new database called: routineflow_db
-- 3. Select the database → Import tab → choose this file
-- 4. Click "Go" to execute
--
-- ⚠️  This file is managed by the LEADER.
--     Team members: do NOT modify table structures.
-- ============================================

-- Create database (if not exists)
CREATE DATABASE IF NOT EXISTS routineflow_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE routineflow_db;

-- ============================================
-- TABLE 1: users (LEADER)
-- Central user management for all modules
-- ============================================
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'admin') DEFAULT 'student',
    profile_pic VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- TABLE 2: exercises (MEMBER B)
-- Exercise Tracker Module
-- ============================================
CREATE TABLE IF NOT EXISTS exercises (
    exercise_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    activity_type VARCHAR(50) NOT NULL,
    duration_minutes INT NOT NULL,
    calories_burned INT DEFAULT 0,
    intensity ENUM('low', 'medium', 'high') DEFAULT 'medium',
    notes TEXT,
    exercise_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- TABLE 3: diary_entries (MEMBER C)
-- Diary Journal Module
-- ============================================
CREATE TABLE IF NOT EXISTS diary_entries (
    entry_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    mood ENUM('happy', 'excited', 'neutral', 'sad', 'angry', 'anxious') NOT NULL,
    tags VARCHAR(255) DEFAULT NULL,
    entry_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- TABLE 4: transactions (MEMBER D)
-- Money Tracker Module
-- ============================================
CREATE TABLE IF NOT EXISTS transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    transaction_type ENUM('income', 'expense') NOT NULL,
    transaction_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- TABLE 5: habits (LEADER / MEMBER A)
-- Habit Tracker Module
-- ============================================
CREATE TABLE IF NOT EXISTS habits (
    habit_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    habit_name VARCHAR(100) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    target_frequency ENUM('daily', 'weekly', 'monthly') DEFAULT 'daily',
    color VARCHAR(7) DEFAULT '#06b6d4',
    icon VARCHAR(50) DEFAULT 'star',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- TABLE 6: habit_completions (LEADER / MEMBER A)
-- Tracks daily habit completion status
-- ============================================
CREATE TABLE IF NOT EXISTS habit_completions (
    completion_id INT AUTO_INCREMENT PRIMARY KEY,
    habit_id INT NOT NULL,
    user_id INT NOT NULL,
    completion_date DATE NOT NULL,
    status ENUM('completed', 'missed') DEFAULT 'completed',
    notes VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (habit_id) REFERENCES habits(habit_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    UNIQUE KEY unique_habit_date (habit_id, completion_date)
) ENGINE=InnoDB;

-- ============================================
-- SAMPLE DATA: Admin user
-- Password: admin123 (hashed with password_hash)
-- ============================================
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@routineflow.com', '$2y$10$YourHashedPasswordHere', 'admin');

-- ============================================
-- SAMPLE DATA: Test student user
-- Password: student123 (hashed with password_hash)
-- ============================================
INSERT INTO users (username, email, password, role) VALUES
('student1', 'student1@routineflow.com', '$2y$10$YourHashedPasswordHere', 'student');
