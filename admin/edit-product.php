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
                <a href="logout.php" style="color: #f87171; margin-top: 30px;">Logout</a>
            </nav>
        </aside>

        <section class="main-content">
            <h1 style="font-size: 1.8rem; margin-bottom: 20px;">Edit Product</h1>

            <?php if ($message): ?>
                <div style="background: #fee2e2; color: var(--danger); padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <?php if ($product): ?>
                <div style="background: #fff; padding: 24px; border-radius: var(--radius); border: 1px solid var(--border); max-width: 650px;">
                    <form action="edit-product.php?id=<?= (int) $productId ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Product Title</label>
                            <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($product['title']) ?>">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label for="price">Price (Rs.)</label>
                                <input type="number" step="0.01" id="price" name="price" class="form-control" required value="<?= htmlspecialchars($product['price']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock Quantity</label>
                                <input type="number" id="stock" name="stock" class="form-control" required value="<?= (int) $product['stock'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">No category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= (int) $category['id'] ?>" <?= (int) $product['category_id'] === (int) $category['id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea id="description" name="description" rows="4" class="form-control"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image_url">Image URL</label>
                            <input type="url" id="image_url" name="image_url" class="form-control" value="<?= htmlspecialchars($product['image'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="image">Replace Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        </div>

                        <label style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
                            <input type="checkbox" name="featured" value="1" <?= (int) $product['featured'] === 1 ? 'checked' : '' ?>>
                            Show on homepage
                        </label>
                        <label style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
                            <input type="checkbox" name="active" value="1" <?= (int) $product['active'] === 1 ? 'checked' : '' ?>>
                            Active on storefront
                        </label>

                        <button type="submit" class="btn btn-primary" style="padding: 12px 24px;">Save Changes</button>
                        <a href="products.php" class="btn btn-outline" style="margin-left: 8px;">Back to Products</a>
                    </form>
                </div>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
