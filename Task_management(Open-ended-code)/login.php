<?php
require_once 'config/config.php';
require_once 'classes/User.php';
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}
$error = '';
$success_message = getFlashMessage('success_message');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    if (!empty($username) && !empty($password)) {
        $user->username = $username;
        $user->password = $password;
        $user_data = $user->login();
        if ($user_data) {
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['full_name'] = $user_data['full_name'];
            $_SESSION['email'] = $user_data['email'];
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Please enter both username and password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1><?php echo APP_NAME; ?></h1>
                <p>Sign in to manage your tasks</p>
            </div>
            <?php if ($success_message): ?>
                <div class="alert alert-success">
                    ✓ <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-error">
                    ⚠️ <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label class="form-label" for="username">Username or Email</label>
                    <input type="text" id="username" name="username" class="form-input" 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                           required autofocus>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                <p class="text-center mt-2">
                    Don't have an account? <a href="register.php" style="color: var(--primary); font-weight: 600;">Register here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
