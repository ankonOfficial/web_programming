<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce Landing - Shop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <nav class="navbar">
      <div class="logo">Shop</div>
      <ul class="nav-links">
        <li><a href="index.php" class="active-link">Home</a></li> 
        <li><a href="products.php">Products</a></li> 
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <?php if (isset($_SESSION['user'])): ?>
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="logout.php" style="color: #e74c3c; font-weight: bold;">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="signup.php">Signup</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Welcome to Shop</h1>
      <p>Your one-stop shop for quality products</p>
      <a href="products.php" class="btn">Shop Now</a>
    </div>
  </section>

  <section class="products">
    <div class="catalog-header">
      <h2>Top Products</h2>
      <p>Discover our latest collection at the best prices.</p>
    </div>
    <div class="catalog-grid">
      <div class="product-card-lg">
        <div class="product-tag">Electronics</div>
        <div class="product-image-container">
          <img src="photo/Wireless Earbuds.jpg" alt="Wireless Earbuds">
        </div>
        <h3>Wireless Earbuds</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$49.99</p>
        <a href="products.php" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Fashion</div>
        <div class="product-image-container">
          <img src="photo/Stylish T-Shirt.jpg" alt="Stylish T-Shirt">
        </div>
        <h3>Stylish T-Shirt</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$29.99</p>
        <a href="products.php" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Home</div>
        <div class="product-image-container">
          <img src="photo/Table Lamp.jpg" alt="Table Lamp">
        </div>
        <h3>Table Lamp</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$59.99</p>
        <a href="products.php" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Electronics</div>
        <div class="product-image-container">
          <img src="photo/Smart Watch.jpg" alt="Smart Watch">
        </div>
        <h3>Smart Watch</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$99.99</p>
        <a href="products.php" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Fashion</div>
        <div class="product-image-container">
          <img src="photo/Denim Jeans.jpg" alt="Denim Jeans">
        </div>
        <h3>Denim Jeans</h3>
        <div class="rating">⭐⭐⭐☆☆</div>
        <p class="price">$39.99</p>
        <a href="products.php" class="btn add-to-cart">Add to Cart</a>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 ULAB Shop. All Rights Reserved.</p>
  </footer>

</body>
</html>