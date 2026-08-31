<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

$user = require_customer($conn, 'checkout.php');

$_SESSION['cart'] ??= [];
$cart = cart_items();
$items = $cart['items'];
$orderPlaced = false;
$orderId = null;
$error = '';

$name = $user['name'] ?? '';
$email = $user['email'] ?? '';
$address = '';
$paymentMethods = payment_methods();
$paymentMethod = 'cod';
$banks = ['hdfc' => 'HDFC Bank', 'icici' => 'ICICI Bank', 'sbi' => 'State Bank of India', 'axis' => 'Axis Bank'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $items) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $paymentMethod = (string) ($_POST['payment_method'] ?? 'cod');
    $upiId = trim($_POST['upi_id'] ?? '');
    $cardName = trim($_POST['card_name'] ?? '');
    $cardNumber = preg_replace('/\D+/', '', (string) ($_POST['card_number'] ?? ''));
    $cardExpiry = trim($_POST['card_expiry'] ?? '');
    $cardCvv = preg_replace('/\D+/', '', (string) ($_POST['card_cvv'] ?? ''));
    $bank = (string) ($_POST['bank'] ?? '');

    if ($name === '') {
        $error = 'Please enter your name.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif ($address === '') {
        $error = 'Please enter your delivery address.';
    } elseif (!isset($paymentMethods[$paymentMethod])) {
        $error = 'Please choose a valid payment method.';
    } elseif ($paymentMethod === 'upi' && $upiId === '') {
        $error = 'Please enter a demo UPI ID.';
    } elseif ($paymentMethod === 'card' && ($cardName === '' || strlen($cardNumber) < 12 || strlen($cardNumber) > 19 || !preg_match('/^\d{2}\/\d{2}$/', $cardExpiry) || strlen($cardCvv) < 3 || strlen($cardCvv) > 4)) {
        $error = 'Please enter valid demo card details.';
    } elseif ($paymentMethod === 'net_banking' && !isset($banks[$bank])) {
        $error = 'Please select a bank.';
    } else {
        try {
            $conn->beginTransaction();
            $freshCart = cart_items();
            if (!$freshCart['items']) {
                throw new RuntimeException('Cart is empty.');
            }

            $stmt = $conn->prepare("INSERT INTO orders (user_id, customer_name, customer_email, customer_address, total_amount, payment_method, payment_status, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending', 'pending')");
            $stmt->execute([(int) $user['id'], $name, $email, $address, $freshCart['total'], $paymentMethod]);
            $orderId = (int) $conn->lastInsertId();

            $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?)");
            $stockStmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ? AND active = 1 AND stock >= ?");

            foreach ($freshCart['items'] as $item) {
                $product = $item['product'];
                $quantity = (int) $item['quantity'];
                $stockStmt->execute([$quantity, (int) $product['id'], $quantity]);
                if ($stockStmt->rowCount() !== 1) {
                    throw new RuntimeException('Insufficient stock.');
                }
                $itemStmt->execute([$orderId, (int) $product['id'], $product['title'], (float) $product['price'], $quantity, (float) $item['total']]);
            }

            $conn->commit();
            $_SESSION['cart'] = [];
            $_SESSION['last_order_id'] = $orderId;
            header('Location: order-success.php?id=' . $orderId);
            exit;
        } catch (Throwable $exception) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            $error = 'Unable to complete your order. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Kalactive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <?php include __DIR__ . '/includes/public-nav.php'; ?>
    <main class="max-w-[760px] mx-auto px-5 pt-32 pb-16">
        <a href="cart.php" class="text-xs uppercase tracking-widest text-[#974724] underline underline-offset-4">Back to cart</a>
        <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mt-8 mb-8">Checkout</h1>

        <?php if ($orderPlaced): ?>
            <div class="border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8">
                <p class="text-[#474740] mb-3">Thank you. Your order has been placed.</p>
                <p class="text-sm text-[#78776f] mb-6">Order #<?= (int) $orderId ?> is now visible in the admin dashboard.</p>
                <a href="products.php" class="btn-primary">Continue shopping</a>
            </div>
        <?php elseif (!$items): ?>
            <p class="text-[#474740] mb-8">Your cart is empty.</p>
            <a href="products.php" class="btn-primary">Browse collection</a>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="border border-[#974724]/40 bg-[#ffdbce]/40 text-[#772f0d] p-4 mb-6"><?= e($error) ?></div>
            <?php endif; ?>
            <form method="POST" class="border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8 space-y-5">
                <input name="name" class="w-full border-[#c9c7bd] bg-[#faf9f5]" placeholder="Name" value="<?= e($name) ?>" required>
                <input name="email" class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="email" placeholder="Email" value="<?= e($email) ?>" required>
                <textarea name="address" class="w-full border-[#c9c7bd] bg-[#faf9f5]" rows="4" placeholder="Delivery address" required><?= e($address) ?></textarea>
                <fieldset class="border-t border-[#c9c7bd] pt-5">
                    <legend class="text-xs uppercase tracking-widest text-[#974724] mb-4">Payment Method</legend>
                    <div class="grid sm:grid-cols-2 gap-3">
                        <?php foreach ($paymentMethods as $value => $label): ?>
                            <label class="payment-option border border-[#c9c7bd] bg-[#faf9f5] p-4 cursor-pointer flex gap-3 items-start">
                                <input type="radio" name="payment_method" value="<?= e($value) ?>" <?= $paymentMethod === $value ? 'checked' : '' ?> required>
                                <span>
                                    <span class="block font-['Playfair_Display'] text-xl text-[#1b1c1a]"><?= e($label) ?></span>
                                    <span class="block text-sm text-[#78776f] mt-1">Demo payment · Pending</span>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <div class="payment-details mt-4 space-y-3" data-payment-details="upi">
                        <input name="upi_id" class="w-full border-[#c9c7bd] bg-[#faf9f5]" placeholder="Demo UPI ID">
                    </div>
                    <div class="payment-details mt-4 space-y-3" data-payment-details="card">
                        <input name="card_name" class="w-full border-[#c9c7bd] bg-[#faf9f5]" placeholder="Name on card">
                        <input name="card_number" class="w-full border-[#c9c7bd] bg-[#faf9f5]" inputmode="numeric" autocomplete="off" placeholder="Demo card number">
                        <div class="grid grid-cols-2 gap-3">
                            <input name="card_expiry" class="w-full border-[#c9c7bd] bg-[#faf9f5]" placeholder="MM/YY">
                            <input name="card_cvv" class="w-full border-[#c9c7bd] bg-[#faf9f5]" inputmode="numeric" autocomplete="off" placeholder="CVV">
                        </div>
                    </div>
                    <div class="payment-details mt-4" data-payment-details="net_banking">
                        <select name="bank" class="w-full border-[#c9c7bd] bg-[#faf9f5]">
                            <option value="">Select bank</option>
                            <?php foreach ($banks as $value => $label): ?>
                                <option value="<?= e($value) ?>"><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </fieldset>
                <div class="space-y-2 border-t border-[#c9c7bd] pt-5">
                    <div class="flex justify-between"><span>Subtotal</span><strong><?= e(money_inr($cart['subtotal'])) ?></strong></div>
                    <div class="flex justify-between"><span>Shipping</span><strong><?= $cart['shipping'] > 0 ? e(money_inr($cart['shipping'])) : 'Free' ?></strong></div>
                    <div class="flex justify-between text-xl"><span>Total</span><strong><?= e(money_inr($cart['total'])) ?></strong></div>
                </div>
                <button class="btn-primary" type="submit">Place order</button>
            </form>
        <?php endif; ?>
    </main>
    <script>
    (function () {
        const groups = document.querySelectorAll('[data-payment-details]');
        const radios = document.querySelectorAll('input[name="payment_method"]');

        function syncPaymentDetails() {
            const selected = document.querySelector('input[name="payment_method"]:checked')?.value || 'cod';
            groups.forEach(function (group) {
                group.style.display = group.dataset.paymentDetails === selected ? 'block' : 'none';
            });
        }

        radios.forEach(function (radio) {
            radio.addEventListener('change', syncPaymentDetails);
        });
        syncPaymentDetails();
    })();
    </script>
    <script src="js/script.js"></script>
</body>
</html>
