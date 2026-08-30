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

function db_first_env(array $keys, string $default = ''): string
{
    foreach ($keys as $key) {
        $value = db_env($key);
        if ($value !== '') {
            return $value;
        }
    }

    return $default;
}

$databaseUrl = db_first_env(['DATABASE_URL', 'MYSQL_URL', 'MYSQL_PUBLIC_URL', 'MYSQL_PRIVATE_URL', 'CLEARDB_DATABASE_URL', 'JAWSDB_URL']);
$databaseParts = $databaseUrl !== '' ? parse_url($databaseUrl) : [];
if (!is_array($databaseParts)) {
    $databaseParts = [];
}

$isRender = db_env('RENDER') !== '' || db_env('RENDER_SERVICE_ID') !== '' || db_env('RENDER_EXTERNAL_URL') !== '';
$hostCandidates = [db_env('DB_HOST'), db_env('MYSQL_HOST'), db_env('MYSQLHOST'), db_env('MYSQL_ADDON_HOST'), $databaseParts['host'] ?? ''];
$envHost = '';
foreach ($hostCandidates as $host) {
    $host = (string) $host;
    if ($host !== '' && (!$isRender || !db_is_local_host($host))) {
        $envHost = $host;
        break;
    }
}

define('DB_HOST', $envHost !== '' ? $envHost : ($isRender ? '' : '127.0.0.1'));
define('DB_PORT', db_first_env(['DB_PORT', 'MYSQL_PORT', 'MYSQLPORT', 'MYSQL_ADDON_PORT'], isset($databaseParts['port']) ? (string) $databaseParts['port'] : ($envHost !== '' ? '3306' : '3310')));
define('DB_USER', db_first_env(['DB_USER', 'MYSQL_USER', 'MYSQLUSER', 'MYSQL_ADDON_USER'], isset($databaseParts['user']) ? rawurldecode((string) $databaseParts['user']) : 'root'));
define('DB_PASS', db_first_env(['DB_PASS', 'MYSQL_PASSWORD', 'MYSQLPASSWORD', 'MYSQL_ADDON_PASSWORD'], isset($databaseParts['pass']) ? rawurldecode((string) $databaseParts['pass']) : ''));
define('DB_NAME', db_first_env(['DB_NAME', 'MYSQL_DATABASE', 'MYSQLDATABASE', 'MYSQL_ADDON_DB'], isset($databaseParts['path']) ? ltrim((string) $databaseParts['path'], '/') : 'ecommerce_db'));
define('SQLITE_PATH', db_first_env(['SQLITE_PATH', 'SQLITE_DATABASE'], __DIR__ . '/../database/ecommerce.sqlite'));

$conn = null;
$connectionError = DB_HOST === '' ? 'DB_HOST is not configured.' : '';

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
            $connectionError = $e->getMessage();
        }
    }
}

if (!$conn && $connectionError === '') {
    $connectionError = 'PDO MySQL driver is unavailable.';
}

if (!$conn && in_array('sqlite', PDO::getAvailableDrivers(), true) && is_file(SQLITE_PATH)) {
    try {
        $conn = new PDO('sqlite:' . SQLITE_PATH, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $conn->exec('PRAGMA foreign_keys = ON');
    } catch (PDOException $e) {
        $connectionError = $e->getMessage();
    }
}

if (!$conn) {
    error_log('Database connection failed: ' . $connectionError);
    http_response_code(500);
    die("Unable to connect to the store database. Please try again later.");
}
?>
