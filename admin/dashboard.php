<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/session.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
    
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2 style="font-size: 1.2rem; color: #fff; margin-bottom: 24px; padding-left: 12px;">⚙️ Admin Panel</h2>
            <nav>
                <a href="dashboard.php" class="active">📊 Dashboard</a>
                <a href="products.php">📦 Products</a>
                <a href="add-product.php">➕ Add Product</a>
                <a href="../index.php" target="_blank">🌐 View Store</a>
                <a href="login.php" style="color: #f87171; margin-top: 30px;">🚪 Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <div class="dashboard-header">
                <h1>Dashboard Overview</h1>
                <span style="color: var(--text-muted);">Welcome, <?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin') ?></span>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Total Sales</p>
                    <h3 style="font-size: 1.8rem; color: var(--primary); margin-top: 8px;">$12,450.00</h3>
                </div>
                <div class="stat-card">
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Total Orders</p>
                    <h3 style="font-size: 1.8rem; color: var(--text-main); margin-top: 8px;">158</h3>
                </div>
                <div class="stat-card">
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Total Products</p>
                    <h3 style="font-size: 1.8rem; color: var(--text-main); margin-top: 8px;">24</h3>
                </div>
                <div class="stat-card">
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Registered Users</p>
                    <h3 style="font-size: 1.8rem; color: var(--text-main); margin-top: 8px;">89</h3>
                </div>
            </div>
        </section>
    </div>
</body>
</html>



