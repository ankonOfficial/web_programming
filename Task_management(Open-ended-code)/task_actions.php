<?php
require_once 'config/config.php';
require_once 'classes/Task.php';
requireAuth();
$database = new Database();
$db = $database->getConnection();
$task = new Task($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    if ($action === 'create') {
        $task->user_id = $_SESSION['user_id'];
        $task->title = sanitize($_POST['title']);
        $task->description = sanitize($_POST['description']);
        $task->status = sanitize($_POST['status']);
        $task->priority = sanitize($_POST['priority']);
        $task->due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;
        if ($task->create()) {
            $_SESSION['success_message'] = "Task created successfully!";
        } else {
            $_SESSION['error_message'] = "Failed to create task.";
        }
    } elseif ($action === 'update') {
        $task->id = $_POST['task_id'];
        $task->user_id = $_SESSION['user_id'];
        $task->title = sanitize($_POST['title']);
        $task->description = sanitize($_POST['description']);
        $task->status = sanitize($_POST['status']);
        $task->priority = sanitize($_POST['priority']);
        $task->due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;
        if ($task->update()) {
            $_SESSION['success_message'] = "Task updated successfully!";
        } else {
            $_SESSION['error_message'] = "Failed to update task.";
        }
    }
    header('Location: dashboard.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $task_id = $_GET['id'];
    if ($task->delete($task_id, $_SESSION['user_id'])) {
        $_SESSION['success_message'] = "Task deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to delete task.";
    }
    header('Location: dashboard.php');
    exit();
}
header('Location: dashboard.php');
exit();
?>
