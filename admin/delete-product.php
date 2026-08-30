<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productId > 0) {
    $stmt = $conn->prepare("UPDATE products SET active = 0, featured = 0 WHERE id = ?");
    $stmt->execute([$productId]);
}

header("Location: products.php?deleted=1");
exit;
?>


