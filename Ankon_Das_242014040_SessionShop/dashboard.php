<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Shop</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .dashboard-header {
      background: #f39c12;
      color: #fff;
      padding: 30px;
      text-align: center;
      margin-top: 20px;
    }
    .dashboard-header h1 {
      margin: 0;
      font-size: 32px;
    }
    .dashboard-content {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
    }
    .dashboard-content h2 {
      color: #333;
      margin-bottom: 20px;
    }
    .dashboard-info {
      background: #f5f5f5;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 30px;
    }
    .dashboard-info p {
      font-size: 16px;
      color: #555;
      margin: 10px 0;
    }
    .dashboard-options {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }
    .dashboard-card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .dashboard-card h3 {
      color: #333;
      margin-bottom: 15px;
    }
    .dashboard-card p {
      color: #777;
      margin-bottom: 15px;
      font-size: 14px;
    }
    .dashboard-card a {
      display: inline-block;
      background: #f39c12;
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .dashboard-card a:hover {
      background: #d35400;
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
        <li><a href="logout.php" style="color: #e74c3c; font-weight: bold;">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="dashboard-header">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>You are now logged in to your account</p>
  </div>

  <div class="dashboard-content">
    <div class="dashboard-info">
      <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
      <p><strong>Session Status:</strong> Active</p>
      <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
    </div>

    <h2>Dashboard Options</h2>
    <div class="dashboard-options">
      <div class="dashboard-card">
        <h3>Browse Products</h3>
        <p>Explore our amazing collection of products and find what you need.</p>
        <a href="products.php">View Products</a>
      </div>
      <div class="dashboard-card">
        <h3>My Account</h3>
        <p>Manage your account settings and personal information.</p>
        <a href="#">Account Settings</a>
      </div>
      <div class="dashboard-card">
        <h3>My Orders</h3>
        <p>View your order history and track current orders.</p>
        <a href="#">View Orders</a>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 ULAB Shop. All Rights Reserved.</p>
  </footer>

</body>
</html>