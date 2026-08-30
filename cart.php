<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';

$_SESSION['cart'] ??= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = (int) ($_POST['product_id'] ?? 0);
    if ($productId > 0 && isset($_SESSION['cart'][$productId])) {
        if ($action === 'remove') {
            unset($_SESSION['cart'][$productId]);
        } elseif ($action === 'increase') {
            $product = find_product($productId);
            if ($product) {
                $_SESSION['cart'][$productId] = min((int) $product['stock'], (int) $_SESSION['cart'][$productId] + 1);
            }
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$productId] = (int) $_SESSION['cart'][$productId] - 1;
            if ($_SESSION['cart'][$productId] <= 0) {
                unset($_SESSION['cart'][$productId]);
            }
        }
    }
    header('Location: cart.php');
    exit;
}

$cart = cart_items();
$items = $cart['items'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Kalactive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <div class="texture-overlay"></div>
    <?php include __DIR__ . '/includes/public-nav.php'; ?>
    <main class="max-w-[1100px] mx-auto px-5 md:px-16 pt-32 pb-16">
        <a href="products.php" class="text-xs uppercase tracking-widest text-[#974724] underline underline-offset-4">Continue shopping</a>
        <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mt-8 mb-10">Cart</h1>

        <?php if (!$items): ?>
            <p class="text-[#474740] mb-8">Your cart is empty.</p>
            <a href="products.php" class="btn-primary">Browse collection</a>
        <?php else: ?>
            <div class="border-y border-[#c9c7bd] divide-y divide-[#c9c7bd]">
                <?php foreach ($items as $item): $product = $item['product']; ?>
                    <div class="grid grid-cols-[84px_1fr] md:grid-cols-[84px_1fr_auto] gap-5 py-5 items-center">
                        <img src="<?= htmlspecialchars(product_image_src($product)) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="w-20 h-24 object-cover border border-[#c9c7bd]">
                        <div>
                            <a href="product.php?id=<?= (int) $product['id'] ?>" class="font-['Playfair_Display'] text-2xl hover:text-[#974724]"><?= htmlspecialchars($product['title']) ?></a>
                            <p class="text-sm text-[#78776f] mt-1"><?= htmlspecialchars(money_inr($product['price'])) ?> each</p>
                            <form method="POST" class="flex flex-wrap items-center gap-3 mt-3">
                                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                                <button class="btn-secondary !px-3 !py-2" name="action" value="decrease" type="submit">-</button>
                                <span class="text-sm text-[#78776f]">Qty <?= (int) $item['quantity'] ?></span>
                                <button class="btn-secondary !px-3 !py-2" name="action" value="increase" type="submit">+</button>
                                <button class="text-xs uppercase tracking-widest text-[#974724] underline underline-offset-4" name="action" value="remove" type="submit">Remove</button>
                            </form>
                        </div>
                        <p class="md:text-right col-span-2 md:col-span-1"><?= htmlspecialchars(money_inr($item['total'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-8 space-y-3 text-lg">
                <div class="flex justify-between"><span>Subtotal</span><strong><?= htmlspecialchars(money_inr($cart['subtotal'])) ?></strong></div>
                <div class="flex justify-between"><span>Shipping</span><strong><?= $cart['shipping'] > 0 ? htmlspecialchars(money_inr($cart['shipping'])) : 'Free' ?></strong></div>
                <div class="flex justify-between border-t border-[#c9c7bd] pt-3 text-xl"><span>Total</span><strong><?= htmlspecialchars(money_inr($cart['total'])) ?></strong></div>
            </div>
            <a href="checkout.php" class="btn-primary mt-8">Checkout</a>
        <?php endif; ?>
    </main>
</body>
</html>
