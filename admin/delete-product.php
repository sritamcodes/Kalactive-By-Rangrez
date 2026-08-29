<?php
require_once __DIR__ . '/../config/database.php';

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

$db = getDBConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    try {
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $msg = "Product #{$id} has been deleted successfully.";
    } catch (PDOException $e) {
        $msg = "Failed to delete product: " . $e->getMessage();
    }
} else {
    $msg = "Invalid product ID.";
}

header("Location: products.php?msg=" . urlencode($msg));
exit();
