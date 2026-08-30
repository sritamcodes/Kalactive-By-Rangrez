<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();

$productId = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $productId > 0 && $conn instanceof PDO) {
    $stmt = $conn->prepare("UPDATE products SET active = 0, featured = 0 WHERE id = ?");
    $stmt->execute([$productId]);
}

header("Location: products.php?deleted=1");
exit;
?>


