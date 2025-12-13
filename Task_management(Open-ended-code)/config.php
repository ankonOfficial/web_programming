<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'task_management_system');
define('APP_NAME', 'Task Manager');
class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
function requireAuth() {
    requireLogin();
}
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
function setFlashMessage($key, $message) {
    $_SESSION[$key] = $message;
}
function getFlashMessage($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}
function formatDate($date) {
    return date('M d, Y', strtotime($date));
}
function isOverdue($due_date) {
    return strtotime($due_date) < strtotime(date('Y-m-d'));
}
?>
