<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    
    $uname = $conn->real_escape_string($_POST['uname']);
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass_confirm'];
    
    if (strlen($uname) < 3) {
        $error = "Username must be at least 3 characters!";
    } elseif (strlen($pass) < 4) {
        $error = "Password must be at least 4 characters!";
    } elseif ($pass !== $pass_confirm) {
        $error = "Passwords do not match!";
    } else {
        $check_sql = "SELECT * FROM users WHERE uname = '$uname'";
        $check_result = $conn->query($check_sql);
        
        if ($check_result->num_rows > 0) {
            $error = "Username already exists!";
        } else {
            $insert_sql = "INSERT INTO users (uname, pass) VALUES ('$uname', '$pass')";
            
            if ($conn->query($insert_sql) === TRUE) {
                $message = "Account created successfully! <a href='login.php'>Login here</a>";
            } else {
                $error = "Error creating account: " . $conn->error;
            }
        }
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup - Shop</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .signup-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      background: #fff;
    }
    .signup-container h2 {
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
    .message {
      color: #27ae60;
      margin-bottom: 15px;
      text-align: center;
    }
    .message a {
      color: #f39c12;
      text-decoration: none;
    }
    .error {
      color: #e74c3c;
      margin-bottom: 15px;
      text-align: center;
    }
    .btn-signup {
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
    .btn-signup:hover {
      background: #d35400;
    }
    .signup-footer {
      text-align: center;
      margin-top: 15px;
    }
    .signup-footer a {
      color: #f39c12;
      text-decoration: none;
    }
    .signup-footer a:hover {
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

  <div class="signup-container">
    <h2>Create Account</h2>
    <?php if ($message): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
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
      <div class="form-group">
        <label for="pass_confirm">Confirm Password:</label>
        <input type="password" id="pass_confirm" name="pass_confirm" required>
      </div>
      <button type="submit" class="btn-signup">Sign Up</button>
    </form>
    <div class="signup-footer">
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 ULAB Shop. All Rights Reserved.</p>
  </footer>

</body>
</html>