<?php
require_once __DIR__ . '/config/database.php';

$db = getDBConnection();
$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$orderStmt = $db->prepare("SELECT * FROM orders WHERE id = ?");
$orderStmt->execute([$orderId]);
$order = $orderStmt->fetch();

if (!$order) {
    header("Location: index.php");
    exit();
}

$pageTitle = 'Order Confirmed #' . $order['id'];

$itemsStmt = $db->prepare("SELECT oi.*, p.title FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
$itemsStmt->execute([$orderId]);
$items = $itemsStmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<main class="py-16 md:py-24 px-4 max-w-container-max mx-auto">
    <div class="max-w-2xl mx-auto border border-outline-variant p-8 md:p-12 bg-primary-container card-shadow text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary text-white rounded-full mb-6">
            <span class="material-symbols-outlined text-3xl">check</span>
        </div>
        
        <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">ORDER CONFIRMED</h1>
        <p class="font-body-md text-on-surface-variant mb-8">
            Thank you for your order! Your Order ID is <strong class="text-secondary">#<?= $order['id']; ?></strong>.
        </p>

        <div class="text-left bg-background border border-outline-variant p-6 mb-8 text-sm space-y-3">
            <h3 class="font-headline-md text-headline-md text-on-background pb-3 border-b border-outline-variant mb-4">ORDER RECEIPT</h3>
            
            <p><strong class="font-label-sm uppercase tracking-widest text-primary">Name:</strong> <?= sanitize($order['shipping_name']); ?></p>
            <p><strong class="font-label-sm uppercase tracking-widest text-primary">Email:</strong> <?= sanitize($order['shipping_email']); ?></p>
            <p><strong class="font-label-sm uppercase tracking-widest text-primary">Shipping Address:</strong> <?= sanitize($order['shipping_address']); ?>, <?= sanitize($order['city']); ?> - <?= sanitize($order['zip_code']); ?></p>
            <p><strong class="font-label-sm uppercase tracking-widest text-primary">Payment Method:</strong> <?= sanitize($order['payment_method']); ?></p>
            <p><strong class="font-label-sm uppercase tracking-widest text-primary">Status:</strong> <span class="text-secondary font-semibold uppercase"><?= sanitize($order['order_status']); ?></span></p>

            <h4 class="font-label-sm uppercase tracking-widest text-primary pt-4 mb-2">PURCHASED PIECES:</h4>
            <div class="space-y-2">
                <?php foreach ($items as $item): ?>
                    <div class="flex justify-between font-body-md">
                        <span><?= sanitize($item['title']); ?> (x<?= $item['quantity']; ?>)</span>
                        <span class="font-semibold">₹<?= number_format($item['price'] * $item['quantity'], 0); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="w-full h-[1px] bg-outline-variant my-4"></div>
            <div class="flex justify-between font-headline-md text-lg text-on-background">
                <span>Total Paid</span>
                <span class="text-secondary">₹<?= number_format($order['total_amount'], 0); ?></span>
            </div>
        </div>

        <a href="products.php" class="btn-primary">CONTINUE SHOPPING &rarr;</a>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
