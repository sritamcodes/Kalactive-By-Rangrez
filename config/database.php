<?php
/**
 * Database Configuration
 */

function db_env(string $key, string $default = ''): string
{
    $value = getenv($key);
    if ($value === false && isset($_ENV[$key])) {
        $value = $_ENV[$key];
    }
    if ($value === false && isset($_SERVER[$key])) {
        $value = $_SERVER[$key];
    }

    return $value === false || $value === '' ? $default : (string) $value;
}

$envHost = db_env('DB_HOST');

define('DB_HOST', $envHost !== '' ? $envHost : '127.0.0.1');
define('DB_PORT', db_env('DB_PORT', $envHost !== '' ? '3306' : '3310'));
define('DB_USER', db_env('DB_USER', 'root'));
define('DB_PASS', db_env('DB_PASS'));
define('DB_NAME', db_env('DB_NAME', 'ecommerce_db'));

$conn = null;

if (in_array('mysql', PDO::getAvailableDrivers(), true)) {
    $ports = $envHost !== '' ? [DB_PORT] : array_unique([DB_PORT, '3306']);
    foreach ($ports as $port) {
        try {
            $conn = new PDO("mysql:host=" . DB_HOST . ";port=" . $port . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
                PDO::ATTR_TIMEOUT => 2,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            break;
        } catch (PDOException $e) {
            // Try the next configured MySQL port.
        }
    }
}

if (!$conn) {
    http_response_code(500);
    die("Unable to connect to the MySQL store database. Please try again later.");
}
?>
