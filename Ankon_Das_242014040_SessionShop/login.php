<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    
    $uname = $conn->real_escape_string($_POST['uname']);
    $pass = $_POST['pass'];
    
    $sql = "SELECT * FROM users WHERE uname = '$uname'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['pass'] == $pass) {
            $_SESSION['user'] = $uname;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Shop</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      background: #fff;
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-weight: bold;
    }
    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }
    .form-group input:focus {
      outline: none;
      border-color: #f39c12;
    }
    .error {
      color: #e74c3c;
      margin-bottom: 15px;
      text-align: center;
    }
    .btn-login {
      width: 100%;
      padding: 10px;
      background: #f39c12;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .btn-login:hover {
      background: #d35400;
    }
    .login-footer {
      text-align: center;
      margin-top: 15px;
    }
    .login-footer a {
      color: #f39c12;
      text-decoration: none;
    }
    .login-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <header>
    <nav class="navbar">
      <div class="logo">Shop</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li> 
        <li><a href="products.php">Products</a></li> 
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <div class="login-container">
    <h2>Login</h2>
    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label for="uname">Username:</label>
        <input type="text" id="uname" name="uname" required>
      </div>
      <div class="form-group">
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>
      </div>
      <button type="submit" class="btn-login">Login</button>
    </form>
    <div class="login-footer">
      <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 ULAB Shop. All Rights Reserved.</p>
  </footer>

</body>
</html>