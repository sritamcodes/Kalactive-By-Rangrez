<?php
require_once __DIR__ . '/../config/database.php';

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

$db = getDBConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: products.php");
    exit();
}

$catStmt = $db->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $catStmt->fetchAll();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $categoryId = (int)($_POST['category_id'] ?? 0);
    $price = (float)($_POST['price'] ?? 0);
    $stock = (int)($_POST['stock'] ?? 0);
    $description = sanitize($_POST['description'] ?? '');
    $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    if (empty($title) || $categoryId <= 0 || $price <= 0) {
        $error = 'Please enter a valid title, select a category, and specify a price > 0.';
    } else {
        $imageName = $product['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = __DIR__ . '/../images/products/';
                if (move_uploaded_file($fileTmpPath, $uploadFileDir . $newFileName)) {
                    $imageName = $newFileName;
                }
            }
        }

        try {
            $updateStmt = $db->prepare("UPDATE products SET category_id = ?, title = ?, slug = ?, description = ?, price = ?, stock = ?, image = ?, is_featured = ? WHERE id = ?");
            $updateStmt->execute([$categoryId, $title, $slug, $description, $price, $stock, $imageName, $isFeatured, $id]);

            header("Location: products.php?msg=" . urlencode("Product updated successfully!"));
            exit();
        } catch (PDOException $e) {
            $error = 'Error updating product: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product #<?= $product['id']; ?> | Kalactive Admin</title>
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
        <main class="admin-content" style="max-width: 800px;">
            <h1 style="margin-bottom: 1.5rem;">Edit Product: <?= sanitize($product['title']); ?></h1>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <div style="background: var(--card-bg); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border-color);">
                <form method="POST" action="edit-product.php?id=<?= $product['id']; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Product Title *</label>
                        <input type="text" name="title" class="form-control" required value="<?= sanitize($product['title']); ?>">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="category_id" class="form-control" required>
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= $c['id']; ?>" <?= $product['category_id'] == $c['id'] ? 'selected' : ''; ?>><?= sanitize($c['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Price ($USD) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" required value="<?= $product['price']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Current Stock *</label>
                            <input type="number" name="stock" class="form-control" required value="<?= $product['stock']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description *</label>
                        <textarea name="description" class="form-control" rows="5" required><?= sanitize($product['description']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Change Product Image (Leave blank to keep current)</label>
                        <input type="file" name="image" id="productImageInput" class="form-control" accept="image/*">
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.4rem;">Current Image File: <code><?= sanitize($product['image']); ?></code></p>
                        <img id="productImagePreview" src="" alt="Preview" style="display: none; max-width: 150px; margin-top: 1rem; border-radius: 8px;">
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" <?= $product['is_featured'] ? 'checked' : ''; ?>>
                        <label for="is_featured" style="margin-bottom: 0; cursor: pointer;">Feature on Store Homepage slider/grid</label>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem;">Update Product</button>
                        <a href="products.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
