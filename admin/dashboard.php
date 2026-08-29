<?php
require_once __DIR__ . '/../config/database.php';

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

$db = getDBConnection();

// Fetch summary metrics
$totalSales = $db->query("SELECT SUM(total_amount) FROM orders WHERE payment_status = 'Paid'")->fetchColumn() ?: 0;
$totalOrders = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalUsers = $db->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn();

// Recent 5 orders
$recentOrdersStmt = $db->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
$recentOrders = $recentOrdersStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Kalactive</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <!-- Header -->
    <header class="navbar">
        <div class="container nav-wrapper">
            <a href="dashboard.php" class="brand-logo">KAL<span>ACTIVE</span> <small style="font-size: 0.8rem; color: var(--primary);">[Admin]</small></a>
            <div class="nav-actions">
                <span style="font-size: 0.9rem; font-weight: 600;">Welcome, <?= sanitize($_SESSION['user_name']); ?></span>
                <a href="../index.php" class="btn btn-secondary" target="_blank">View Site ↗</a>
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </header>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <a href="dashboard.php" class="active">📊 Dashboard Overview</a>
            <a href="products.php">📦 Manage Products</a>
            <a href="add-product.php">➕ Add New Product</a>
            <a href="../index.php">🌐 Customer Storefront</a>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <h1 style="margin-bottom: 1.5rem;">System Dashboard</h1>

            <!-- Metric Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                <div style="background: var(--card-bg); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <span style="color: var(--text-muted); font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Total Revenue</span>
                    <h2 style="font-size: 1.8rem; color: var(--primary); margin-top: 0.25rem;">$<?= number_format($totalSales, 2); ?></h2>
                </div>

                <div style="background: var(--card-bg); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <span style="color: var(--text-muted); font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Total Orders</span>
                    <h2 style="font-size: 1.8rem; color: var(--dark); margin-top: 0.25rem;"><?= $totalOrders; ?></h2>
                </div>

                <div style="background: var(--card-bg); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <span style="color: var(--text-muted); font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Active Products</span>
                    <h2 style="font-size: 1.8rem; color: var(--dark); margin-top: 0.25rem;"><?= $totalProducts; ?></h2>
                </div>

                <div style="background: var(--card-bg); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <span style="color: var(--text-muted); font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Registered Users</span>
                    <h2 style="font-size: 1.8rem; color: var(--dark); margin-top: 0.25rem;"><?= $totalUsers; ?></h2>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h2>Recent Customer Orders</h2>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentOrders)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted);">No orders recorded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentOrders as $order): ?>
                                <tr>
                                    <td><strong>#<?= $order['id']; ?></strong></td>
                                    <td>
                                        <?= sanitize($order['shipping_name']); ?>
                                        <div style="font-size: 0.8rem; color: var(--text-muted);"><?= sanitize($order['shipping_email']); ?></div>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($order['created_at'])); ?></td>
                                    <td><strong>$<?= number_format($order['total_amount'], 2); ?></strong></td>
                                    <td><?= sanitize($order['payment_method']); ?></td>
                                    <td><span class="badge badge-success"><?= sanitize($order['order_status']); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>
