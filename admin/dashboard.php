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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ivory: #f5f1e8;
            --paper: #f9f5f0;
            --panel: #fffdf9;
            --terracotta: #b86a45;
            --sand: #c69d70;
            --charcoal: #1f1d1a;
            --ink: #2e2a27;
            --muted: #6b635d;
            --line: rgba(31,29,26,0.12);
            --shadow: 0 22px 44px rgba(31, 29, 26, 0.08);
            --success: #216f4f;
            --warning: #a5662d;
            --danger: #9f4139;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f1e8, #f1e9df);
            color: var(--ink);
        }
        a { text-decoration: none; }
        .admin-layout {
            display: flex;
            min-height: 100vh;
            background: rgba(255,255,255,0.2);
        }
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1b1917, #2a2623);
            color: #f0ede8;
            padding: 28px 18px 20px;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        .sidebar h2 {
            margin: 0 0 18px;
            padding: 0 10px;
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            letter-spacing: -0.04em;
        }
        .sidebar nav {
            display: grid;
            gap: 8px;
        }
        .sidebar a {
            display: block;
            padding: 12px 14px;
            border-radius: 10px;
            color: rgba(255,255,255,0.78);
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.72rem;
        }
        .sidebar a.active, .sidebar a:hover {
            background: rgba(184, 106, 69, 0.18);
            color: #fff;
        }
        .sidebar .logout {
            margin-top: 28px;
            color: #f6b9a6;
        }
        .main-content {
            flex: 1;
            min-width: 0;
            padding: 28px 28px 40px;
        }
        .dashboard-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
        }
        .admin-kicker {
            margin: 0 0 10px;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.7rem;
            color: var(--terracotta);
            font-weight: 700;
        }
        h1 {
            margin: 0;
            font-size: clamp(2rem, 2vw + 1.1rem, 2.8rem);
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.05em;
            color: var(--charcoal);
        }
        .header-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 0.9rem;
        }
        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(33, 111, 79, 0.08);
            border: 1px solid rgba(33,111,79,0.18);
            color: var(--success);
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }
        .live-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 0 rgba(33,111,79,0.4);
            animation: pulse 1.8s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(33,111,79,0.4); }
            70% { box-shadow: 0 0 0 9px rgba(33,111,79,0); }
            100% { box-shadow: 0 0 0 0 rgba(33,111,79,0); }
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(160px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }
        .stat-card, .admin-panel {
            background: rgba(255,255,255,0.72);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow);
        }
        .stat-card {
            padding: 18px 18px 16px;
        }
        .stat-card p {
            margin: 0 0 10px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.68rem;
            font-weight: 700;
        }
        .stat-card h3 {
            margin: 0;
            font-size: clamp(1.5rem, 2vw, 2.2rem);
            color: var(--charcoal);
            letter-spacing: -0.05em;
        }
        .dashboard-panels {
            display: grid;
            grid-template-columns: minmax(0, 1.7fr) minmax(260px, 1fr);
            gap: 20px;
        }
        .admin-panel {
            padding: 18px 18px 12px;
            overflow: hidden;
        }
        .admin-panel h2 {
            margin: 0 0 14px;
            font-size: 1.2rem;
            color: var(--charcoal);
            font-family: 'Playfair Display', serif;
        }
        .table-scroll {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            min-width: 840px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid rgba(31,29,26,0.08);
            text-align: left;
            vertical-align: top;
            font-size: 0.88rem;
        }
        th {
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-size: 0.68rem;
            font-weight: 700;
        }
        tbody tr:hover {
            background: rgba(184, 106, 69, 0.03);
        }
        .admin-list { display: grid; gap: 12px; }
        .admin-list > div {
            display: grid;
            gap: 4px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(31,29,26,0.08);
        }
        .admin-list strong { color: var(--charcoal); }
        .admin-list span { color: var(--muted); font-size: 0.85rem; }
        @media (max-width: 980px) {
            .admin-layout { display: block; }
            .sidebar { width: 100%; }
            .sidebar nav { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); }
            .main-content { padding: 20px 18px 28px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(150px, 1fr)); }
            .dashboard-panels { grid-template-columns: 1fr; }
        }
        @media (max-width: 560px) {
            .stats-grid { grid-template-columns: 1fr; }
            .header-meta { width: 100%; justify-content: space-between; }
        }
    </style>
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
                <a href="logout.php" class="logout">Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <div class="dashboard-header">
                <div>
                    <p class="admin-kicker">Commerce Operating System</p>
                    <h1>Dashboard Overview</h1>
                </div>
                <div class="header-meta">
                    <span class="live-badge">Live</span>
                    <span>Welcome, <?= e(first_name($admin)) ?> · <span data-updated-at>Last updated --</span></span>
                </div>
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
                if (!response.ok) {
                    throw new Error('Dashboard request failed with HTTP ' + response.status);
                }
                const data = await response.json();
                if (!data.ok) {
                    throw new Error(data.message || 'Dashboard data is unavailable.');
                }
                text('[data-stat="revenue"]', formatInr.format(Number(data.stats.revenue || 0)));
                text('[data-stat="orders"]', data.stats.orders || 0);
                text('[data-stat="products"]', data.stats.products || 0);
                text('[data-stat="customers"]', data.stats.customers || 0);
                text('[data-updated-at]', 'Last updated ' + (data.updated_at || '--'));
                renderRows('[data-recent-orders]', data.recent_orders || []);
                renderList('[data-top-products]', data.top_products || [], 'No product sales yet.', function (item) {
                    return '<div><strong>' + escapeHtml(item.product_name) + '</strong><span>' + escapeHtml(item.units) + ' units · ' + formatInr.format(Number(item.revenue || 0)) + '</span></div>';
                });
                renderList('[data-low-stock]', data.low_stock || [], 'No low-stock products.', function (item) {
                    return '<div><strong>' + escapeHtml(item.title) + '</strong><span>' + escapeHtml(item.stock) + ' left</span></div>';
                });
            } catch (error) {
                console.error('Unable to refresh dashboard:', error);
                text('[data-updated-at]', 'Last updated --');
            }
        }

        function startPolling() {
            if (timer) return;
            refreshDashboard();
            timer = setInterval(refreshDashboard, 8000);
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
