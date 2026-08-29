<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (!empty($title) && !empty($price)) {
        // Save product logic
        $message = "Product added successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
    
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2 style="font-size: 1.2rem; color: #fff; margin-bottom: 24px; padding-left: 12px;">⚙️ Admin Panel</h2>
            <nav>
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="products.php">📦 Products</a>
                <a href="add-product.php" class="active">➕ Add Product</a>
                <a href="../index.php" target="_blank">🌐 View Store</a>
                <a href="login.php" style="color: #f87171; margin-top: 30px;">🚪 Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <h1>Add New Product</h1>

            <?php if ($message): ?>
                <div style="background: #dcfce7; color: var(--success); padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <div style="background: #fff; padding: 24px; border-radius: var(--radius); border: 1px solid var(--border); max-width: 650px;">
                <form action="add-product.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" class="form-control" required placeholder="e.g. Wireless Noise Canceling Headphones">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label for="price">Price ($)</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" required placeholder="99.99">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock Quantity</label>
                            <input type="number" id="stock" name="stock" class="form-control" required placeholder="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea id="description" name="description" rows="4" class="form-control" placeholder="Enter detailed product description..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding: 12px 24px;">Create Product</button>
                    <a href="products.php" class="btn btn-outline" style="margin-left: 8px;">Cancel</a>
                </form>
            </div>
        </section>
    </div>
</body>
</html>



