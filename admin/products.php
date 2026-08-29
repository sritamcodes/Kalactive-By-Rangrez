<?php
require_once __DIR__ . '/../config/database.php';

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

$db = getDBConnection();

$stmt = $db->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC");
$products = $stmt->fetchAll();

$msg = isset($_GET['msg']) ? sanitize($_GET['msg']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Kalactive Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <!-- Header -->
    <header class="navbar">
        <div class="container nav-wrapper">
            <a href="dashboard.php" class="brand-logo">KAL<span>ACTIVE</span> <small style="font-size: 0.8rem; color: var(--primary);">[Admin]</small></a>
            <div class="nav-actions">
                <a href="../index.php" class="btn btn-secondary" target="_blank">View Site ↗</a>
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </header>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <a href="dashboard.php">📊 Dashboard Overview</a>
            <a href="products.php" class="active">📦 Manage Products</a>
            <a href="add-product.php">➕ Add New Product</a>
            <a href="../index.php">🌐 Customer Storefront</a>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h1>Product Inventory</h1>
                <a href="add-product.php" class="btn btn-primary">➕ Create New Product</a>
            </div>

            <?php if (!empty($msg)): ?>
                <div class="alert alert-success"><?= $msg; ?></div>
            <?php endif; ?>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-muted);">No products registered in the database.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $p): ?>
                                <tr>
                                    <td>#<?= $p['id']; ?></td>
                                    <td><strong><?= sanitize($p['title']); ?></strong></td>
                                    <td><?= sanitize($p['category_name']); ?></td>
                                    <td>$<?= number_format($p['price'], 2); ?></td>
                                    <td>
                                        <?php if ($p['stock'] > 10): ?>
                                            <span class="badge badge-success"><?= $p['stock']; ?> in stock</span>
                                        <?php elseif ($p['stock'] > 0): ?>
                                            <span class="badge badge-warning"><?= $p['stock']; ?> low stock</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Out of stock</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $p['is_featured'] ? '⭐ Yes' : 'No'; ?></td>
                                    <td style="display: flex; gap: 0.5rem;">
                                        <a href="edit-product.php?id=<?= $p['id']; ?>" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Edit</a>
                                        <a href="delete-product.php?id=<?= $p['id']; ?>" class="btn btn-danger confirm-delete" data-item="<?= sanitize($p['title']); ?>" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
