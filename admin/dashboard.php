<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();
$admin = current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Kalactive</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2>Kalactive Ops</h2>
            <nav>
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="products.php">Products</a>
                <a href="add-product.php">Add Product</a>
                <a href="../index.php" target="_blank">View Store</a>
                <a href="logout.php" style="color: #f87171; margin-top: 30px;">Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <div class="dashboard-header">
                <div>
                    <p class="admin-kicker">Commerce Operating System</p>
                    <h1>Dashboard Overview</h1>
                </div>
                <span>Welcome, <?= e(first_name($admin)) ?> · Updated <span data-updated-at>--</span></span>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <p>Total Revenue</p>
                    <h3 data-stat="revenue">Rs. 0</h3>
                </div>
                <div class="stat-card">
                    <p>Total Orders</p>
                    <h3 data-stat="orders">0</h3>
                </div>
                <div class="stat-card">
                    <p>Total Products</p>
                    <h3 data-stat="products">0</h3>
                </div>
                <div class="stat-card">
                    <p>Registered Customers</p>
                    <h3 data-stat="customers">0</h3>
                </div>
            </div>

            <div class="dashboard-panels">
                <section class="admin-panel">
                    <h2>Recent Orders</h2>
                    <div class="table-scroll">
                        <table>
                            <thead><tr><th>Order</th><th>Customer</th><th>Email</th><th>Total</th><th>Payment</th><th>Payment Status</th><th>Status</th><th>Created</th></tr></thead>
                            <tbody data-recent-orders><tr><td colspan="8">Loading...</td></tr></tbody>
                        </table>
                    </div>
                </section>

                <section class="admin-panel">
                    <h2>Top Products</h2>
                    <div data-top-products class="admin-list">Loading...</div>
                </section>

                <section class="admin-panel">
                    <h2>Low Stock</h2>
                    <div data-low-stock class="admin-list">Loading...</div>
                </section>
            </div>
        </section>
    </div>

    <script>
    (function () {
        const formatInr = new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 0 });
        let timer = null;

        function text(selector, value) {
            const node = document.querySelector(selector);
            if (node) node.textContent = value;
        }

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, function (char) {
                return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char];
            });
        }

        function renderRows(target, rows) {
            const tbody = document.querySelector(target);
            if (!tbody) return;
            if (!rows.length) {
                tbody.innerHTML = '<tr><td colspan="8">No orders yet.</td></tr>';
                return;
            }
            tbody.innerHTML = rows.map(function (order) {
                const labels = { cod: 'Cash on Delivery', upi: 'UPI', card: 'Credit/Debit Card', net_banking: 'Net Banking' };
                return '<tr><td>#' + escapeHtml(order.id) + '</td><td>' + escapeHtml(order.customer_name) + '</td><td>' + escapeHtml(order.customer_email) + '</td><td>' + formatInr.format(Number(order.total_amount || 0)) + '</td><td>' + escapeHtml(labels[order.payment_method] || order.payment_method || 'Cash on Delivery') + '</td><td>' + escapeHtml(order.payment_status || 'Pending') + '</td><td>' + escapeHtml(order.status) + '</td><td>' + escapeHtml(order.created_at) + '</td></tr>';
            }).join('');
        }

        function renderList(target, rows, empty, renderer) {
            const node = document.querySelector(target);
            if (!node) return;
            node.innerHTML = rows.length ? rows.map(renderer).join('') : '<p>' + empty + '</p>';
        }

        async function refreshDashboard() {
            try {
                const response = await fetch('dashboard-data.php', { headers: { 'Accept': 'application/json' } });
                const data = await response.json();
                if (!data.ok) return;
                text('[data-stat="revenue"]', formatInr.format(Number(data.stats.revenue || 0)));
                text('[data-stat="orders"]', data.stats.orders || 0);
                text('[data-stat="products"]', data.stats.products || 0);
                text('[data-stat="customers"]', data.stats.customers || 0);
                text('[data-updated-at]', data.updated_at || '--');
                renderRows('[data-recent-orders]', data.recent_orders || []);
                renderList('[data-top-products]', data.top_products || [], 'No product sales yet.', function (item) {
                    return '<div><strong>' + escapeHtml(item.product_name) + '</strong><span>' + escapeHtml(item.units) + ' units · ' + formatInr.format(Number(item.revenue || 0)) + '</span></div>';
                });
                renderList('[data-low-stock]', data.low_stock || [], 'No low-stock products.', function (item) {
                    return '<div><strong>' + escapeHtml(item.title) + '</strong><span>' + escapeHtml(item.stock) + ' left</span></div>';
                });
            } catch (error) {}
        }

        function startPolling() {
            if (timer) return;
            refreshDashboard();
            timer = setInterval(refreshDashboard, 7000);
        }

        function stopPolling() {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        }

        document.addEventListener('visibilitychange', function () {
            document.hidden ? stopPolling() : startPolling();
        });

        startPolling();
    })();
    </script>
</body>
</html>
