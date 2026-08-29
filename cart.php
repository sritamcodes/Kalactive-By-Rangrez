<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';
session_start();

$_SESSION['cart'] ??= [];

if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][(int) $_GET['remove']]);
    header('Location: cart.php');
    exit;
}

$items = [];
$total = 0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    $product = find_product((int) $id);
    if (!$product) {
        continue;
    }
    $lineTotal = (float) $product['price'] * (int) $quantity;
    $items[] = ['product' => $product, 'quantity' => (int) $quantity, 'total' => $lineTotal];
    $total += $lineTotal;
}
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <div class="texture-overlay"></div>
    <main class="max-w-[1100px] mx-auto px-5 md:px-16 py-16">
        <a href="products.php" class="text-xs uppercase tracking-widest text-[#974724] underline underline-offset-4">Continue shopping</a>
        <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mt-8 mb-10">Cart</h1>

        <?php if (!$items): ?>
            <p class="text-[#474740] mb-8">Your cart is empty.</p>
            <a href="products.php" class="btn-primary">Browse collection</a>
        <?php else: ?>
            <div class="border-y border-[#c9c7bd] divide-y divide-[#c9c7bd]">
                <?php foreach ($items as $item): $product = $item['product']; ?>
                    <div class="grid grid-cols-[84px_1fr_auto] gap-5 py-5 items-center">
                        <img src="<?= htmlspecialchars(product_image_src($product)) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="w-20 h-24 object-cover border border-[#c9c7bd]">
                        <div>
                            <a href="product.php?id=<?= (int) $product['id'] ?>" class="font-['Playfair_Display'] text-2xl hover:text-[#974724]"><?= htmlspecialchars($product['title']) ?></a>
                            <p class="text-sm text-[#78776f] mt-1">Qty <?= (int) $item['quantity'] ?></p>
                            <a href="cart.php?remove=<?= (int) $product['id'] ?>" class="text-xs uppercase tracking-widest text-[#974724] underline underline-offset-4 mt-3 inline-block">Remove</a>
                        </div>
                        <p><?= htmlspecialchars(money_inr($item['total'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-between items-center mt-8 text-xl">
                <span>Total</span>
                <strong><?= htmlspecialchars(money_inr($total)) ?></strong>
            </div>
            <a href="checkout.php" class="btn-primary mt-8">Checkout</a>
        <?php endif; ?>
    </main>
</body>
</html>
