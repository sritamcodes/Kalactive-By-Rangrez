<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productId > 0) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$productId]);
}

header("Location: products.php?deleted=1");
exit;
?>


