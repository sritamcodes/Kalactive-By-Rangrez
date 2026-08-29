<?php
/**
 * Database Configuration
 */

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3310');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecommerce_db');

$conn = null;

// 1. Attempt MySQL connection if driver is available
if (in_array('mysql', PDO::getAvailableDrivers())) {
    $ports = [DB_PORT, '3306'];
    foreach ($ports as $port) {
        try {
            $conn = new PDO("mysql:host=" . DB_HOST . ";port=" . $port . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
                PDO::ATTR_TIMEOUT => 2,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            break;
        } catch (PDOException $e) {
            // Try next port or fallback
        }
    }
}

// 2. Fallback to pre-seeded SQLite database if MySQL/driver is unavailable
if (!$conn) {
    try {
        $sqliteFile = __DIR__ . '/../database/ecommerce.sqlite';
        $conn = new PDO("sqlite:" . $sqliteFile);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
