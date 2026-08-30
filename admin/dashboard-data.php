<?php
require_once __DIR__ . '/../includes/product-functions.php';
require_once __DIR__ . '/../includes/session.php';

require_admin();
header('Content-Type: application/json');

try {
    $stats = [
        'revenue' => (float) $conn->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders")->fetchColumn(),
        'orders' => (int) $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn(),
        'products' => (int) $conn->query("SELECT COUNT(*) FROM products WHERE active = 1")->fetchColumn(),
        'customers' => (int) $conn->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn(),
    ];

    $recentStmt = $conn->query("SELECT id, customer_name, customer_email, total_amount, payment_method, payment_status, status, created_at FROM orders ORDER BY created_at DESC, id DESC LIMIT 6");
    $topStmt = $conn->query("SELECT product_name, SUM(quantity) AS units, SUM(total) AS revenue FROM order_items GROUP BY product_name ORDER BY units DESC LIMIT 5");
    $lowStockStmt = $conn->query("SELECT id, title, stock FROM products WHERE active = 1 AND stock <= 5 ORDER BY stock ASC, title ASC LIMIT 5");

    echo json_encode([
        'ok' => true,
        'stats' => $stats,
        'recent_orders' => $recentStmt->fetchAll(),
        'top_products' => $topStmt->fetchAll(),
        'low_stock' => $lowStockStmt->fetchAll(),
        'updated_at' => date('H:i:s'),
    ]);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Unable to load dashboard data.']);
}
?>
