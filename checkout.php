<?php
$pageTitle = 'Order Checkout';
require_once __DIR__ . '/config/database.php';

$db = getDBConnection();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Calculate totals
$productIds = array_keys($_SESSION['cart']);
$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$stmt = $db->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$stmt->execute($productIds);
$products = $stmt->fetchAll();

$totalAmount = 0;
$checkoutItems = [];
foreach ($products as $p) {
    $qty = $_SESSION['cart'][$p['id']];
    $subtotal = $p['price'] * $qty;
    $totalAmount += $subtotal;
    $checkoutItems[] = [
        'product' => $p,
        'quantity' => $qty,
        'subtotal' => $subtotal
    ];
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $address = sanitize($_POST['address'] ?? '');
    $city = sanitize($_POST['city'] ?? '');
    $zip = sanitize($_POST['zip_code'] ?? '');
    $paymentMethod = sanitize($_POST['payment_method'] ?? 'Cash on Delivery');

    if (empty($name) || empty($email) || empty($address) || empty($city) || empty($zip)) {
        $error = 'Please fill in all required shipping fields.';
    } else {
        try {
            $db->beginTransaction();

            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            $orderStmt = $db->prepare("INSERT INTO orders (user_id, total_amount, shipping_name, shipping_email, shipping_address, city, zip_code, payment_method, payment_status, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Paid', 'Processing')");
            $orderStmt->execute([$userId, $totalAmount, $name, $email, $address, $city, $zip, $paymentMethod]);
            $orderId = $db->lastInsertId();

            $itemStmt = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $updateStockStmt = $db->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");

            foreach ($checkoutItems as $item) {
                $itemStmt->execute([$orderId, $item['product']['id'], $item['quantity'], $item['product']['price']]);
                $updateStockStmt->execute([$item['quantity'], $item['product']['id']]);
            }

            $db->commit();

            // Clear Cart
            unset($_SESSION['cart']);

            header("Location: order-success.php?id=" . $orderId);
            exit();

        } catch (Exception $e) {
            $db->rollBack();
            $error = 'Failed to place order: ' . $e->getMessage();
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<main class="py-16 md:py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <h1 class="font-headline-xl text-headline-xl text-on-background mb-8">ORDER CHECKOUT</h1>

    <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 border border-error bg-error-container text-on-error-container text-sm font-body-md">
            <?= $error; ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Form Section -->
        <div class="lg:col-span-2 border border-outline-variant p-6 md:p-8 bg-primary-container card-shadow">
            <h2 class="font-headline-md text-headline-md text-on-background mb-6">1. SHIPPING ADDRESS</h2>
            
            <form method="POST" action="checkout.php" class="space-y-6">
                <div>
                    <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">FULL NAME *</label>
                    <input type="text" name="name" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="John Doe" value="<?= sanitize($_SESSION['user_name'] ?? ''); ?>">
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">EMAIL ADDRESS *</label>
                    <input type="email" name="email" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="john@example.com" value="<?= sanitize($_SESSION['user_email'] ?? ''); ?>">
                </div>

                <div>
                    <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">STREET ADDRESS *</label>
                    <textarea name="address" rows="3" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="123 Royal Haveli Way"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">CITY *</label>
                        <input type="text" name="city" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="Jaipur">
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">PIN / ZIP CODE *</label>
                        <input type="text" name="zip_code" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="302001">
                    </div>
                </div>

                <h2 class="font-headline-md text-headline-md text-on-background pt-6 mb-4">2. PAYMENT METHOD</h2>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border border-outline-variant bg-background cursor-pointer hover:border-secondary transition-colors">
                        <input type="radio" name="payment_method" value="Credit Card" checked class="text-secondary focus:ring-secondary">
                        <span class="ml-3 font-body-md text-on-background">💳 Direct Online Payment (Credit / Debit / UPI)</span>
                    </label>
                    <label class="flex items-center p-4 border border-outline-variant bg-background cursor-pointer hover:border-secondary transition-colors">
                        <input type="radio" name="payment_method" value="Cash on Delivery" class="text-secondary focus:ring-secondary">
                        <span class="ml-3 font-body-md text-on-background">💵 Cash on Delivery</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full py-4 text-center mt-6">
                    PLACE ORDER NOW &rarr;
                </button>
            </form>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="border border-outline-variant p-6 bg-surface-container card-shadow h-fit">
            <h3 class="font-headline-md text-headline-md text-on-background mb-6">ORDER ITEMS</h3>
            
            <div class="space-y-4 mb-6">
                <?php foreach ($checkoutItems as $item): ?>
                    <div class="flex justify-between text-sm">
                        <div>
                            <p class="font-body-md font-semibold text-on-background"><?= sanitize($item['product']['title']); ?></p>
                            <p class="font-body-md text-on-surface-variant">Qty: <?= $item['quantity']; ?> × ₹<?= number_format($item['product']['price'], 0); ?></p>
                        </div>
                        <span class="font-body-md font-semibold text-on-background">₹<?= number_format($item['subtotal'], 0); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="w-full h-[1px] bg-outline-variant my-4"></div>

            <div class="flex justify-between font-headline-md text-headline-md text-on-background">
                <span>Total</span>
                <span>₹<?= number_format($totalAmount, 0); ?></span>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
