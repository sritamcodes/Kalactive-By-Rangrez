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

function db_is_local_host(string $host): bool
{
    return in_array(strtolower(trim($host)), ['localhost', '127.0.0.1', '::1'], true);
}

$databaseUrl = db_env('DATABASE_URL', db_env('MYSQL_URL'));
$databaseParts = $databaseUrl !== '' ? parse_url($databaseUrl) : [];
if (!is_array($databaseParts)) {
    $databaseParts = [];
}

$isRender = db_env('RENDER') !== '' || db_env('RENDER_SERVICE_ID') !== '' || db_env('RENDER_EXTERNAL_URL') !== '';
$configuredHost = db_env('DB_HOST', db_env('MYSQLHOST', $databaseParts['host'] ?? ''));
$envHost = $isRender && db_is_local_host($configuredHost) ? '' : $configuredHost;

define('DB_HOST', $envHost !== '' ? $envHost : ($isRender ? '' : '127.0.0.1'));
define('DB_PORT', db_env('DB_PORT', db_env('MYSQLPORT', isset($databaseParts['port']) ? (string) $databaseParts['port'] : ($envHost !== '' ? '3306' : '3310'))));
define('DB_USER', db_env('DB_USER', db_env('MYSQLUSER', isset($databaseParts['user']) ? rawurldecode((string) $databaseParts['user']) : 'root')));
define('DB_PASS', db_env('DB_PASS', db_env('MYSQLPASSWORD', isset($databaseParts['pass']) ? rawurldecode((string) $databaseParts['pass']) : '')));
define('DB_NAME', db_env('DB_NAME', db_env('MYSQLDATABASE', isset($databaseParts['path']) ? ltrim((string) $databaseParts['path'], '/') : 'ecommerce_db')));

$conn = null;

if (DB_HOST !== '' && in_array('mysql', PDO::getAvailableDrivers(), true)) {
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
