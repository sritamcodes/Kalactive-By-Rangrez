<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();

$message = '';
$categories = all_categories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $price = (float) ($_POST['price'] ?? 0);
    $stock = (int) ($_POST['stock'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $categoryId = ($_POST['category_id'] ?? '') !== '' ? (int) $_POST['category_id'] : null;
    $featured = isset($_POST['featured']) ? 1 : 0;
    $image = trim($_POST['image_url'] ?? '');
    $image = uploaded_product_image($image);

    if ($title !== '' && $price > 0) {
        $stmt = $conn->prepare("INSERT INTO products (category_id, title, slug, description, price, stock, image, featured, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
        $stmt->execute([$categoryId, $title, unique_product_slug($title), $description, $price, max(0, $stock), $image, $featured]);
        header("Location: products.php?created=1");
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
    <title>Add Product | Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h2 style="font-size: 1.2rem; color: #fff; margin-bottom: 24px; padding-left: 12px;">Admin Panel</h2>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php">Products</a>
                <a href="add-product.php" class="active">Add Product</a>
                <a href="../index.php" target="_blank">View Store</a>
                <a href="logout.php" style="color: #f87171; margin-top: 30px;">Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <h1>Add New Product</h1>

            <?php if ($message): ?>
                <div style="background: #fee2e2; color: var(--danger); padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <div style="background: #fff; padding: 24px; border-radius: var(--radius); border: 1px solid var(--border); max-width: 650px;">
                <form action="add-product.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" class="form-control" required placeholder="Hand-painted ceramic vase">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label for="price">Price (Rs.)</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" required placeholder="4500">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock Quantity</label>
                            <input type="number" id="stock" name="stock" class="form-control" required placeholder="20">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" class="form-control">
                            <option value="">No category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= (int) $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea id="description" name="description" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="url" id="image_url" name="image_url" class="form-control" placeholder="https://...">
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>

                    <label style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
                        <input type="checkbox" name="featured" value="1">
                        Show on homepage
                    </label>

                    <button type="submit" class="btn btn-primary" style="padding: 12px 24px;">Create Product</button>
                    <a href="products.php" class="btn btn-outline" style="margin-left: 8px;">Cancel</a>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
