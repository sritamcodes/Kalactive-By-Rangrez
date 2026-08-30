<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();

$products = admin_products();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ivory: #f4efe7;
            --paper: #f9f5f0;
            --panel: #fffdf9;
            --terracotta: #b86a45;
            --charcoal: #1f1d1a;
            --ink: #2a2724;
            --muted: #6d655d;
            --line: rgba(31,29,26,0.12);
            --shadow: 0 20px 40px rgba(31,29,26,0.08);
            --success: #2a6748;
            --warning: #a06b34;
            --danger: #8f3d36;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f1e8, #f0e7dd);
            color: var(--ink);
        }
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1d1a18, #2f2a26);
            color: #f5efe9;
            padding: 28px 18px 20px;
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
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .sidebar a.active, .sidebar a:hover {
            background: rgba(184, 106, 69, 0.14);
            color: #fff;
        }
        .sidebar .logout {
            margin-top: 28px;
            color: #f5b5a4;
        }
        .main-content {
            flex: 1;
            min-width: 0;
            padding: 30px 28px 40px;
        }
        .topbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            gap: 16px;
        }
        h1 {
            margin: 0;
            font-size: clamp(2rem, 3vw, 2.6rem);
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.05em;
            color: var(--charcoal);
        }
        .btn {
            border: none;
            border-radius: 12px;
            padding: 11px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 0.74rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--terracotta), #89563a);
            color: #fff;
        }
        .panel {
            background: rgba(255,255,255,0.7);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 18px;
            overflow: hidden;
        }
        .table-scroll {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            min-width: 980px;
            border-collapse: collapse;
        }
        th, td {
            border-bottom: 1px solid rgba(31,29,26,0.08);
            padding: 12px 10px;
            text-align: left;
            vertical-align: middle;
            font-size: 0.88rem;
        }
        th {
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-size: 0.67rem;
            font-weight: 700;
        }
        td img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid rgba(31,29,26,0.08);
        }
        .btn-outline {
            background: transparent;
            border: 1px solid rgba(31,29,26,0.18);
            color: var(--ink);
            padding: 7px 12px;
        }
        .btn-danger {
            background: rgba(143, 61, 54, 0.08);
            color: var(--danger);
            border: 1px solid rgba(143, 61, 54, 0.14);
            padding: 7px 12px;
        }
        form { display: inline; }
        @media (max-width: 980px) {
            .admin-layout { display: block; }
            .sidebar { width: 100%; }
            .sidebar nav { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); }
            .main-content { padding: 20px 18px 28px; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php" class="active">Products</a>
                <a href="add-product.php">Add Product</a>
                <a href="../index.php" target="_blank">View Store</a>
                <a href="logout.php" class="logout">Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <div class="topbar">
                <h1>Product Inventory</h1>
                <a href="add-product.php" class="btn btn-primary">+ Add New</a>
            </div>

            <div class="panel table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th><th>Image</th><th>Product Title</th><th>Category</th><th>Price</th><th>Stock</th><th>Homepage</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= (int) $product['id'] ?></td>
                                <td><img src="<?= e(product_image_src($product, '../')) ?>" alt="<?= e($product['title']) ?>"></td>
                                <td><?= e($product['title']) ?></td>
                                <td><?= e($product['category_name'] ?? '-') ?></td>
                                <td><?= e(money_inr($product['price'])) ?></td>
                                <td><?= (int) $product['stock'] ?></td>
                                <td><?= (int) $product['featured'] === 1 ? 'Yes' : 'No' ?></td>
                                <td><?= (int) $product['active'] === 1 ? 'Active' : 'Inactive' ?></td>
                                <td>
                                    <a href="edit-product.php?id=<?= (int) $product['id'] ?>" class="btn btn-outline">Edit</a>
                                    <form action="delete-product.php" method="POST" onsubmit="return confirm('Deactivate this product?')">
                                        <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                        <button type="submit" class="btn btn-danger">Deactivate</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
