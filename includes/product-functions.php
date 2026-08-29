<?php
require_once __DIR__ . '/../config/database.php';

function db_driver(): string
{
    global $conn;
    return $conn->getAttribute(PDO::ATTR_DRIVER_NAME);
}

function db_column_exists(string $table, string $column): bool
{
    global $conn;

    if (db_driver() === 'sqlite') {
        $stmt = $conn->query("PRAGMA table_info($table)");
        foreach ($stmt->fetchAll() as $row) {
            if (($row['name'] ?? '') === $column) {
                return true;
            }
        }
        return false;
    }

    $stmt = $conn->prepare("SHOW COLUMNS FROM `$table` LIKE ?");
    $stmt->execute([$column]);
    return (bool) $stmt->fetch();
}

function ensure_product_schema(): void
{
    global $conn;

    if (!db_column_exists('products', 'featured')) {
        $conn->exec("ALTER TABLE products ADD COLUMN featured TINYINT NOT NULL DEFAULT 0");
        $conn->exec("UPDATE products SET featured = 1 WHERE id IN (1, 2, 3, 4)");
        $conn->exec("UPDATE products SET price = 12000.00 WHERE id = 2");
        $conn->exec("UPDATE products SET price = 8900.00 WHERE id = 3");
        $conn->exec("UPDATE products SET price = 2200.00 WHERE id = 4");
    }
}

function product_slug(string $title): string
{
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug !== '' ? $slug : 'product';
}

function unique_product_slug(string $title, ?int $ignoreId = null): string
{
    global $conn;

    $base = product_slug($title);
    $slug = $base;
    $suffix = 2;

    while (true) {
        $sql = "SELECT id FROM products WHERE slug = ?";
        $params = [$slug];
        if ($ignoreId) {
            $sql .= " AND id <> ?";
            $params[] = $ignoreId;
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        if (!$stmt->fetch()) {
            return $slug;
        }
        $slug = $base . '-' . $suffix;
        $suffix++;
    }
}

function money_inr($price): string
{
    return 'Rs. ' . number_format((float) $price, 0);
}

function product_image(array $product): string
{
    return $product['image'] ?: 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=800&q=80';
}

function product_image_src(array $product, string $relativePrefix = ''): string
{
    $image = product_image($product);
    if (preg_match('/^https?:\/\//', $image)) {
        return $image;
    }
    return $relativePrefix . $image;
}

function all_categories(): array
{
    global $conn;
    return $conn->query("SELECT id, name FROM categories ORDER BY name")->fetchAll();
}

function featured_products(int $limit = 4): array
{
    global $conn;
    ensure_product_schema();
    $stmt = $conn->prepare("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id WHERE p.featured = 1 ORDER BY p.id LIMIT ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function catalogue_products(): array
{
    global $conn;
    ensure_product_schema();
    return $conn->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id ORDER BY p.id")->fetchAll();
}

function find_product(int $id): ?array
{
    global $conn;
    ensure_product_schema();
    $stmt = $conn->prepare("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id WHERE p.id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    return $product ?: null;
}

function uploaded_product_image(?string $currentImage = null): ?string
{
    if (empty($_FILES['image']['tmp_name']) || ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return $currentImage;
    }

    $extension = strtolower(pathinfo($_FILES['image']['name'] ?? '', PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (!in_array($extension, $allowed, true)) {
        return $currentImage;
    }

    $uploadDir = __DIR__ . '/../uploads/products';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $filename = 'product-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
    $target = $uploadDir . '/' . $filename;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        return $currentImage;
    }

    return 'uploads/products/' . $filename;
}

ensure_product_schema();
?>
