<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Catalog - Shop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">Shop</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li> 
        <li><a href="products.php" class="active-link">Products</a></li> 
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
  <section class="product-catalog">
    <div class="catalog-header">
      <h1>Explore Our Products</h1>
      <p>Discover our latest collection at the best prices.</p>
    </div>
    <div class="filters-container">
      <div class="filter-group">
        <label for="category">Category:</label>
        <select id="category">
          <option value="all">All</option>
          <option value="electronics">Electronics</option>
          <option value="fashion">Fashion</option>
          <option value="home">Home</option>
        </select>
      </div>
      <div class="filter-group">
        <label for="sort">Sort by:</label>
        <select id="sort">
          <option value="default">Default</option>
          <option value="price-asc">Price: Low to High</option>
          <option value="price-desc">Price: High to Low</option>
        </select>
      </div>
      <input type="text" placeholder="Search products..." class="search-input">
    </div>
    <div class="catalog-grid">
      <div class="product-card-lg">
        <div class="product-tag">Electronics</div>
        <div class="product-image-container">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Wireless%20Earbuds-v2B04fMvdibFSBclbGt5UvK1i3H5k0.jpg" alt="Wireless Earbuds">
        </div>
        <h3>Wireless Earbuds</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$49.99</p>
        <a href="#" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Fashion</div>
        <div class="product-image-container">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Stylish%20T-Shirt-zF5PdExXglBF3U7HN1CC5xOqeJmrwI.jpg" alt="Stylish T-Shirt">
        </div>
        <h3>Stylish T-Shirt</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$29.99</p>
        <a href="#" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Home</div>
        <div class="product-image-container">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Table%20Lamp-cZIkU0SEXY3b0kNlsJel3UniGSh2t2.jpg" alt="Table Lamp">
        </div>
        <h3>Table Lamp</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$59.99</p>
        <a href="#" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Electronics</div>
        <div class="product-image-container">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Smart%20Watch-rK2t23KdCp5G0HhBxQ7YMKZvXclEnP.jpg" alt="Smart Watch">
        </div>
        <h3>Smart Watch</h3>
        <div class="rating">⭐⭐⭐⭐☆</div>
        <p class="price">$99.99</p>
        <a href="#" class="btn add-to-cart">Add to Cart</a>
      </div>
      <div class="product-card-lg">
        <div class="product-tag">Fashion</div>
        <div class="product-image-container">
          <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Denim%20Jeans-KGKmAbX37zSApYEW1iWm6XZXTHygQ9.jpg" alt="Denim Jeans">
        </div>
        <h3>Denim Jeans</h3>
        <div class="rating">⭐⭐⭐☆☆</div>
        <p class="price">$39.99</p>
        <a href="#" class="btn add-to-cart">Add to Cart</a>
      </div>
    </div>
  </section>
  <footer>
    <p>&copy; 2025 ULAB Shop. All Rights Reserved.</p>
  </footer>
</body>
</html>