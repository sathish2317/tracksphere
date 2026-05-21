<?php
// ============================================================
//  TrackSphere — includes/config.php
//  ⚠️  Edit DB credentials before deploying
// ============================================================

// ✅ FIXED: DB host, name, and user must match the SQL dump header
//    Dump says: Host: sql113.infinityfree.com, DB: if0_41980410_tracker
define('DB_HOST', 'sql113.infinityfree.com');
define('DB_NAME', 'if0_41980410_tracker');
define('DB_USER', 'if0_41980410');
define('DB_PASS', 'crack2317');   // ← keep your password here
define('DB_CHAR', 'utf8mb4');

define('SITE_URL', 'https://mobile-tracker.infinityfreeapp.com');

// Session
define('SESSION_LIFETIME', 3600 * 8); // 8 hours

// Tracking — delete location logs every 1 HOUR, store fresh after
define('PING_INTERVAL_SEC',     600);  // 10 minutes
define('LOCATION_RETAIN_HOURS', 1);    // ← 1 hour retention

// Admin registration secret
define('ADMIN_REGISTER_KEY', 'sathish2317');

// ============================================================
//  PDO singleton
// ============================================================
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

// ============================================================
//  JSON response helpers
// ============================================================
function jsonOk(array $data = []): never {
    header('Content-Type: application/json');
    echo json_encode(['ok' => true] + $data);
    exit;
}

function jsonErr(string $msg, int $code = 400): never {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'error' => $msg]);
    exit;
}

// ============================================================
//  Auth helpers
// ============================================================
function requireAdmin(): array {
    $token = $_SERVER['HTTP_X_SESSION_TOKEN'] ?? ($_COOKIE['ts_admin_token'] ?? '');
    if (!$token) jsonErr('Unauthorized', 401);
    $row = db()->prepare('SELECT * FROM admins WHERE session_token = ? AND session_expires > NOW() AND is_active = 1');
    $row->execute([$token]);
    $admin = $row->fetch();
    if (!$admin) jsonErr('Session expired or invalid', 401);
    return $admin;
}

function requireUser(): array {
    $token = $_SERVER['HTTP_X_SESSION_TOKEN'] ?? ($_COOKIE['ts_user_token'] ?? '');
    if (!$token) jsonErr('Unauthorized', 401);
    $row = db()->prepare('SELECT * FROM users WHERE session_token = ? AND session_expires > NOW() AND is_active = 1 AND is_verified = 1');
    $row->execute([$token]);
    $user = $row->fetch();
    if (!$user) jsonErr('Session expired or invalid', 401);
    return $user;
}

function generateToken(int $len = 32): string {
    return bin2hex(random_bytes($len));
}

// ============================================================
//  Security headers
// ============================================================
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, X-Session-Token');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

