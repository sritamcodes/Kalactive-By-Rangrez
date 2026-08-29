<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = "Product updated successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            min-height: 100vh;
        }
        .sidebar {
            background: #0f172a;
            color: #fff;
            padding: 24px 16px;
        }
        .sidebar a {
            color: #94a3b8;
            display: block;
            padding: 12px 16px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: var(--transition);
        }
        .sidebar a:hover, .sidebar a.active {
            background: #1e293b;
            color: #fff;
        }
        .main-content {
            padding: 30px;
            background: #f8fafc;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2 style="font-size: 1.2rem; color: #fff; margin-bottom: 24px; padding-left: 12px;">⚙️ Admin Panel</h2>
            <nav>
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="products.php" class="active">📦 Products</a>
                <a href="add-product.php">➕ Add Product</a>
                <a href="../index.php" target="_blank">🌐 View Store</a>
                <a href="login.php" style="color: #f87171; margin-top: 30px;">🚪 Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <h1 style="font-size: 1.8rem; margin-bottom: 20px;">Edit Product #<?= $productId ?></h1>

            <?php if ($message): ?>
                <div style="background: #dcfce7; color: var(--success); padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <div style="background: #fff; padding: 24px; border-radius: var(--radius); border: 1px solid var(--border); max-width: 650px;">
                <form action="edit-product.php?id=<?= $productId ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" class="form-control" required value="Wireless Headphones">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label for="price">Price ($)</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" required value="99.99">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock Quantity</label>
                            <input type="number" id="stock" name="stock" class="form-control" required value="25">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea id="description" name="description" rows="4" class="form-control">Premium high-fidelity audio headphones with active noise cancellation.</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Replace Image (Optional)</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding: 12px 24px;">Save Changes</button>
                    <a href="products.php" class="btn btn-outline" style="margin-left: 8px;">Back to Products</a>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
