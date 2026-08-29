<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$products = catalogue_products();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2 style="font-size: 1.2rem; color: #fff; margin-bottom: 24px; padding-left: 12px;">Admin Panel</h2>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php" class="active">Products</a>
                <a href="add-product.php">Add Product</a>
                <a href="../index.php" target="_blank">View Store</a>
                <a href="login.php" style="color: #f87171; margin-top: 30px;">Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-size: 1.8rem;">Product Inventory</h1>
                <a href="add-product.php" class="btn btn-primary">+ Add New Product</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Homepage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= (int) $product['id'] ?></td>
                            <td><img src="<?= htmlspecialchars(product_image_src($product, '../')) ?>" style="width: 45px; height: 45px; border-radius: 6px; object-fit: cover;"></td>
                            <td><?= htmlspecialchars($product['title']) ?></td>
                            <td><?= htmlspecialchars($product['category_name'] ?? '-') ?></td>
                            <td><?= htmlspecialchars(money_inr($product['price'])) ?></td>
                            <td><?= (int) $product['stock'] ?></td>
                            <td><?= (int) $product['featured'] === 1 ? 'Yes' : 'No' ?></td>
                            <td>
                                <a href="edit-product.php?id=<?= (int) $product['id'] ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">Edit</a>
                                <a href="delete-product.php?id=<?= (int) $product['id'] ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem;" onclick="return confirm('Delete this product?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
