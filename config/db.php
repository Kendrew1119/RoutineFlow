<?php
/**
 * RoutineFlow — Database Configuration
 * 
 * READ plan.md FIRST before modifying this file.
 * This file is managed by the LEADER only.
 * 
 * Usage: require_once '../../config/db.php';
 * Then use $pdo for all database queries.
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'routineflow_db');
define('DB_USER', 'root');
define('DB_PASS', '');         // Default XAMPP has no password
define('DB_CHARSET', 'utf8mb4');

// Optional API keys
define('WEATHER_API_KEY', ''); // Get from https://openweathermap.org/api

// PDO connection
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // In production, log this instead of displaying
    die('<div style="color:red;font-family:monospace;padding:2rem;">
        <h2>Database Connection Failed</h2>
        <p>' . htmlspecialchars($e->getMessage()) . '</p>
        <p>Make sure XAMPP MySQL is running and database "' . DB_NAME . '" exists.</p>
    </div>');
}
