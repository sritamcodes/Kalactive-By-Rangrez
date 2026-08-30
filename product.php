<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = $productId > 0 ? find_product($productId) : null;
$activePage = 'collections';
$likedProductIds = is_logged_in() ? wishlist_product_ids((int) current_user()['id']) : [];

if (!$product) {
    http_response_code(404);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product) {
    $quantity = max(1, (int) ($_POST['quantity'] ?? 1));
    $quantity = min($quantity, max(0, (int) $product['stock']));
    if ($quantity <= 0) {
        header('Location: product.php?id=' . (int) $product['id']);
        exit;
    }
    $_SESSION['cart'] ??= [];
    $_SESSION['cart'][$product['id']] = ($_SESSION['cart'][$product['id']] ?? 0) + $quantity;
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product ? htmlspecialchars($product['title']) : 'Product not found' ?> | Kalactive</title>
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

    <main class="max-w-[1440px] mx-auto px-5 md:px-16 pt-32 pb-16 md:pb-24">
        <?php if (!$product): ?>
            <h1 class="font-['Playfair_Display'] text-4xl mb-4">Product not found</h1>
            <a href="products.php" class="uppercase tracking-widest text-xs text-[#974724] underline underline-offset-4">Browse collection</a>
        <?php else: ?>
            <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-start">
                <div class="bg-[#efeeea] border border-[#c9c7bd] p-4">
                    <img src="<?= htmlspecialchars(product_image_src($product)) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="w-full aspect-[4/5] object-cover">
                </div>
                <section class="md:pt-8">
                    <p class="text-xs uppercase tracking-widest text-[#974724] mb-5"><?= htmlspecialchars($product['category_name'] ?? 'Collection') ?></p>
                    <h1 class="font-['Playfair_Display'] text-4xl md:text-6xl leading-tight mb-6"><?= htmlspecialchars($product['title']) ?></h1>
                    <p class="text-2xl text-[#474740] mb-8"><?= htmlspecialchars(money_inr($product['price'])) ?></p>
                    <?php if (!empty($product['description'])): ?>
                        <p class="text-[#474740] leading-7 mb-8 max-w-xl"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                    <?php endif; ?>
                    <p class="text-sm text-[#78776f] mb-8"><?= (int) $product['stock'] > 0 ? (int) $product['stock'] . ' in stock' : 'Out of stock' ?></p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <form method="POST" class="flex flex-col sm:flex-row gap-4">
                            <input type="number" name="quantity" min="1" max="<?= (int) $product['stock'] ?>" value="1" class="w-24 border-[#c9c7bd] bg-[#faf9f5]" <?= (int) $product['stock'] <= 0 ? 'disabled' : '' ?>>
                            <button class="btn-primary" type="submit" <?= (int) $product['stock'] <= 0 ? 'disabled' : '' ?>>Add to cart</button>
                        </form>
                        <form method="POST" action="wishlist-toggle.php">
                            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                            <input type="hidden" name="redirect" value="product.php?id=<?= (int) $product['id'] ?>">
                            <button class="btn-secondary" type="submit">
                                <?= in_array((int) $product['id'], $likedProductIds, true) ? 'Saved' : 'Save' ?>
                            </button>
                        </form>
                        <a href="products.php" class="btn-secondary">Continue shopping</a>
                    </div>
                </section>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
