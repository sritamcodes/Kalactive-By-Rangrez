<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productId > 0) {
    // Perform database deletion
    // Example: $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    // $stmt->execute([$productId]);
}

header("Location: products.php?deleted=1");
exit;
?>
