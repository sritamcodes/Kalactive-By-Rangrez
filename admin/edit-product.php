<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = $productId > 0 ? find_product($productId, true) : null;
$categories = all_categories();
$message = '';

if (!$product) {
    http_response_code(404);
    $message = "Product not found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product) {
    $title = trim($_POST['title'] ?? '');
    $price = (float) ($_POST['price'] ?? 0);
    $stock = (int) ($_POST['stock'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $categoryId = ($_POST['category_id'] ?? '') !== '' ? (int) $_POST['category_id'] : null;
    $featured = isset($_POST['featured']) ? 1 : 0;
    $active = isset($_POST['active']) ? 1 : 0;
    $imageUrl = trim($_POST['image_url'] ?? '');
    $image = uploaded_product_image($imageUrl !== '' ? $imageUrl : $product['image']);

    if ($title !== '' && $price > 0) {
        $stmt = $conn->prepare("UPDATE products SET category_id = ?, title = ?, slug = ?, description = ?, price = ?, stock = ?, image = ?, featured = ?, active = ? WHERE id = ?");
        $stmt->execute([$categoryId, $title, unique_product_slug($title, $productId), $description, $price, max(0, $stock), $image, $featured, $active, $productId]);
        header("Location: products.php?updated=1");
        exit;
    }

    $message = "Add a product title and price.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Admin</title>
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
            --danger: #8f3d36;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f1e8, #f0e7dd);
            color: var(--ink);
        }
        a { text-decoration: none; }
        .admin-layout { display: flex; min-height: 100vh; }
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
            color: rgba(255,255,255,0.78);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .sidebar a.active, .sidebar a:hover { background: rgba(184, 106, 69, 0.14); color: #fff; }
        .sidebar .logout { margin-top: 28px; color: #f5b5a4; }
        .main-content {
            flex: 1;
            min-width: 0;
            padding: 30px 28px 40px;
        }
        h1 {
            margin: 0 0 18px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 3vw, 2.6rem);
            letter-spacing: -0.05em;
            color: var(--charcoal);
        }
        .panel {
            background: rgba(255,255,255,0.72);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 22px;
            max-width: 720px;
        }
        .alert {
            background: rgba(143, 61, 54, 0.08);
            border: 1px solid rgba(143, 61, 54, 0.14);
            color: var(--danger);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }
        .form-grid { display: grid; gap: 18px; }
        .form-group { display: grid; gap: 8px; }
        label {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }
        input, select, textarea {
            width: 100%;
            border: 1px solid rgba(31,29,26,0.12);
            background: rgba(255,255,255,0.8);
            border-radius: 12px;
            padding: 13px 12px;
            font: inherit;
            color: var(--ink);
        }
        textarea { min-height: 110px; resize: vertical; }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(184,106,69,0.8);
            box-shadow: 0 0 0 4px rgba(184,106,69,0.10);
        }
        .inline-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            font-weight: 600;
        }
        .checkbox-row input { width: auto; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--terracotta), #89563a);
            color: #fff;
        }
        .btn-outline {
            background: transparent;
            border: 1px solid rgba(31,29,26,0.18);
            color: var(--ink);
        }
        @media (max-width: 980px) {
            .admin-layout { display: block; }
            .sidebar { width: 100%; }
            .sidebar nav { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); }
            .main-content { padding: 20px 18px 28px; }
            .inline-grid { grid-template-columns: 1fr; }
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
            <h1>Edit Product</h1>

            <?php if ($message): ?>
                <div class="alert"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <?php if ($product): ?>
                <div class="panel">
                    <form action="edit-product.php?id=<?= (int) $productId ?>" method="POST" enctype="multipart/form-data" class="form-grid">
                        <div class="form-group">
                            <label for="title">Product Title</label>
                            <input type="text" id="title" name="title" required value="<?= htmlspecialchars($product['title']) ?>">
                        </div>

                        <div class="inline-grid">
                            <div class="form-group">
                                <label for="price">Price (Rs.)</label>
                                <input type="number" step="0.01" id="price" name="price" required value="<?= htmlspecialchars($product['price']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock Quantity</label>
                                <input type="number" id="stock" name="stock" required value="<?= (int) $product['stock'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_id">
                                <option value="">No category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= (int) $category['id'] ?>" <?= (int) $product['category_id'] === (int) $category['id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image_url">Image URL</label>
                            <input type="url" id="image_url" name="image_url" value="<?= htmlspecialchars($product['image'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="image">Replace Image</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        <label class="checkbox-row">
                            <input type="checkbox" name="featured" value="1" <?= (int) $product['featured'] === 1 ? 'checked' : '' ?>>
                            Show on homepage
                        </label>
                        <label class="checkbox-row">
                            <input type="checkbox" name="active" value="1" <?= (int) $product['active'] === 1 ? 'checked' : '' ?>>
                            Active on storefront
                        </label>

                        <div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="products.php" class="btn btn-outline" style="margin-left: 8px;">Back to Products</a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
