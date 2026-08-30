<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';

$orderId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$order = null;

if ($orderId > 0 && (int) ($_SESSION['last_order_id'] ?? 0) === $orderId) {
    $stmt = $conn->prepare("SELECT id, customer_name, customer_email, total_amount, payment_method, payment_status, status, created_at FROM orders WHERE id = ? LIMIT 1");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch() ?: null;
}

if (!$order) {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | Kalactive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <?php include __DIR__ . '/includes/public-nav.php'; ?>
    <main class="max-w-[760px] mx-auto px-5 pt-32 pb-16">
        <?php if (!$order): ?>
            <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mb-6">Order not found</h1>
            <a href="products.php" class="btn-primary">Browse collection</a>
        <?php else: ?>
            <section class="border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8">
                <p class="text-xs uppercase tracking-widest text-[#974724] mb-4">Order Confirmed</p>
                <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mb-4">Thank you. Your order has been placed.</h1>
                <p class="text-sm text-[#78776f] mb-6">Order #<?= (int) $order['id'] ?> is now visible in the admin dashboard.</p>
                <div class="space-y-3 border-y border-[#c9c7bd] py-5 mb-6">
                    <div class="flex justify-between gap-4"><span>Payment Method</span><strong><?= e(payment_method_label($order['payment_method'] ?? 'cod')) ?></strong></div>
                    <div class="flex justify-between gap-4"><span>Payment Status</span><strong><?= e($order['payment_status'] ?? 'Pending') ?></strong></div>
                    <div class="flex justify-between gap-4"><span>Total</span><strong><?= e(money_inr($order['total_amount'])) ?></strong></div>
                </div>
                <a href="products.php" class="btn-primary">Continue shopping</a>
            </section>
        <?php endif; ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>
