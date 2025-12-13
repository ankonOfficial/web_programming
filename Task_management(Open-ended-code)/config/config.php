<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define('APP_NAME', 'TaskMaster Pro');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://localhost/task-management');
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Dhaka');
require_once __DIR__ . '/database.php';
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function getFlashMessage($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}
?>
