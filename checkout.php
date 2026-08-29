<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';
session_start();

$_SESSION['cart'] ??= [];
$items = [];
$total = 0;
$orderPlaced = false;

foreach ($_SESSION['cart'] as $id => $quantity) {
    $product = find_product((int) $id);
    if (!$product) {
        continue;
    }
    $lineTotal = (float) $product['price'] * (int) $quantity;
    $items[] = ['product' => $product, 'quantity' => (int) $quantity, 'total' => $lineTotal];
    $total += $lineTotal;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $items) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($name !== '' && $email !== '' && $address !== '') {
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO orders (user_id, customer_name, customer_email, customer_address, total_amount, payment_method) VALUES (NULL, ?, ?, ?, ?, 'cod')");
        $stmt->execute([$name, $email, $address, $total]);
        $orderId = (int) $conn->lastInsertId();

        $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($items as $item) {
            $product = $item['product'];
            $itemStmt->execute([$orderId, $product['id'], $product['title'], $product['price'], $item['quantity'], $item['total']]);
        }
        $conn->commit();

        $_SESSION['cart'] = [];
        $items = [];
        $orderPlaced = true;
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <main class="max-w-[760px] mx-auto px-5 py-16">
        <a href="cart.php" class="text-xs uppercase tracking-widest text-[#974724] underline underline-offset-4">Back to cart</a>
        <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mt-8 mb-8">Checkout</h1>

        <?php if ($orderPlaced): ?>
            <div class="border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8">
                <p class="text-[#474740] mb-6">Thank you. Your order has been placed.</p>
                <a href="products.php" class="btn-primary">Continue shopping</a>
            </div>
        <?php elseif (!$items): ?>
            <p class="text-[#474740] mb-8">Your cart is empty.</p>
            <a href="products.php" class="btn-primary">Browse collection</a>
        <?php else: ?>
            <form method="POST" class="border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8 space-y-5">
                <input name="name" class="w-full border-[#c9c7bd] bg-[#faf9f5]" placeholder="Name" required>
                <input name="email" class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="email" placeholder="Email" required>
                <textarea name="address" class="w-full border-[#c9c7bd] bg-[#faf9f5]" rows="4" placeholder="Delivery address" required></textarea>
                <div class="flex justify-between border-t border-[#c9c7bd] pt-5">
                    <span>Total</span>
                    <strong><?= htmlspecialchars(money_inr($total)) ?></strong>
                </div>
                <button class="btn-primary" type="submit">Place order</button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>
