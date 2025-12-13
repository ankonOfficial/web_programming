<?php
require_once 'config.php';
require_once 'classes/Task.php';
requireLogin();
$database = new Database();
$db = $database->getConnection();
$task = new Task($db);
$status_filter = isset($_GET['status']) ? $_GET['status'] : null;
$tasks_result = $task->getUserTasks($_SESSION['user_id'], $status_filter);
$tasks = $tasks_result->fetchAll();
$stats = $task->getStats($_SESSION['user_id']);
$success_message = getFlashMessage('success_message');
$error_message = getFlashMessage('error_message');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="dashboard.php" class="navbar-brand"><?php echo APP_NAME; ?></a>
            <ul class="navbar-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li class="user-info">
                    <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['full_name'], 0, 1)); ?></div>
                    <span><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                </li>
                <li><a href="logout.php" class="btn btn-sm btn-danger">Logout</a></li>
            </ul>
        </div>
    </nav>
    <!-- Dashboard Content -->
    <div class="dashboard">
        <div class="container">
            <!-- Header -->
            <div class="dashboard-header">
                <div class="dashboard-title">
                    <div>
                        <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['full_name']); ?>! 👋</h2>
                        <p class="text-muted">Here's what's happening with your tasks today</p>
                    </div>
                    <button class="btn btn-primary" onclick="openAddModal()">+ Add New Task</button>
                </div>
                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon primary">📋</div>
                        <div class="stat-info">
                            <h3><?php echo $stats['total']; ?></h3>
                            <p>Total Tasks</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon warning">⏳</div>
                        <div class="stat-info">
                            <h3><?php echo $stats['pending']; ?></h3>
                            <p>Pending</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon primary">🚀</div>
                        <div class="stat-info">
                            <h3><?php echo $stats['in_progress']; ?></h3>
                            <p>In Progress</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon success">✓</div>
                        <div class="stat-info">
                            <h3><?php echo $stats['completed']; ?></h3>
                            <p>Completed</p>
                        </div>
                    </div>
                </div>
                <?php if ($success_message): ?>
                    <div class="alert alert-success">
                        ✓ <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        ⚠️ <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <!-- Filter Tabs -->
                <div class="filter-tabs">
                    <button class="filter-tab <?php echo !$status_filter ? 'active' : ''; ?>" 
                            onclick="filterTasks('all')">All Tasks</button>
                    <button class="filter-tab <?php echo $status_filter === 'pending' ? 'active' : ''; ?>" 
                            onclick="filterTasks('pending')">Pending</button>
                    <button class="filter-tab <?php echo $status_filter === 'in_progress' ? 'active' : ''; ?>" 
                            onclick="filterTasks('in_progress')">In Progress</button>
                    <button class="filter-tab <?php echo $status_filter === 'completed' ? 'active' : ''; ?>" 
                            onclick="filterTasks('completed')">Completed</button>
                </div>
            </div>
            <!-- Tasks List -->
            <div class="tasks-container">
                <?php if (count($tasks) > 0): ?>
                    <?php foreach ($tasks as $task_item): ?>
                        <?php
                        $is_overdue = false;
                        if ($task_item['due_date'] && $task_item['status'] !== 'completed') {
                            $is_overdue = strtotime($task_item['due_date']) < strtotime('today');
                        }
                        ?>
                        <div class="task-item">
                            <div class="task-header">
                                <div>
                                    <h3 class="task-title"><?php echo htmlspecialchars($task_item['title']); ?></h3>
                                    <?php if ($task_item['description']): ?>
                                        <p class="task-description"><?php echo htmlspecialchars($task_item['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="task-actions">
                                    <button class="btn btn-sm btn-secondary" 
                                            onclick="editTask(<?php echo htmlspecialchars(json_encode($task_item)); ?>)">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                            onclick="deleteTask(<?php echo $task_item['id']; ?>, '<?php echo htmlspecialchars($task_item['title']); ?>')">
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <div class="task-meta">
                                <span class="badge badge-<?php echo $task_item['status']; ?>">
                                    <?php echo str_replace('_', ' ', $task_item['status']); ?>
                                </span>
                                <span class="badge badge-<?php echo $task_item['priority']; ?>">
                                    <?php echo ucfirst($task_item['priority']); ?> Priority
                                </span>
                                <?php if ($task_item['due_date']): ?>
                                    <span class="task-due <?php echo $is_overdue ? 'overdue' : ''; ?>">
                                        📅 <?php echo date('M d, Y', strtotime($task_item['due_date'])); ?>
                                        <?php if ($is_overdue): ?>
                                            (Overdue)
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">📝</div>
                        <h3>No tasks found</h3>
                        <p>Start by creating your first task!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Add/Edit Task Modal -->
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Add New Task</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <form id="taskForm" action="task_actions.php" method="POST">
                <input type="hidden" id="task_id" name="task_id">
                <input type="hidden" id="action" name="action" value="create">
                <div class="form-group">
                    <label class="form-label" for="title">Task Title *</label>
                    <input type="text" id="title" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <textarea id="description" name="description" class="form-textarea"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status *</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="priority">Priority *</label>
                    <select id="priority" name="priority" class="form-select" required>
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" class="form-input">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Save Task</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
