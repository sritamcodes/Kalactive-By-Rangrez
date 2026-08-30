<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$user = current_user();
ensure_wishlist_schema();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    $action = $_POST['action'] ?? '';
    if ($productId > 0) {
        if ($action === 'remove') {
            $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
            $stmt->execute([(int) $user['id'], $productId]);
        } elseif ($action === 'add_to_cart') {
            $product = find_product($productId);
            if ($product && (int) $product['stock'] > 0) {
                $_SESSION['cart'][$productId] = min((int) $product['stock'], (int) ($_SESSION['cart'][$productId] ?? 0) + 1);
            }
        }
    }
    header('Location: wishlist.php');
    exit;
}

$products = wishlist_products((int) $user['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist | Kalactive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <?php include __DIR__ . '/includes/public-nav.php'; ?>
    <main class="max-w-[1100px] mx-auto px-5 md:px-16 pt-32 pb-16">
        <p class="text-xs uppercase tracking-widest text-[#974724] mb-5">Account</p>
        <h1 class="font-['Playfair_Display'] text-4xl md:text-5xl mb-10">Wishlist</h1>
        <?php if (!$products): ?>
            <p class="text-[#474740] mb-8">Your wishlist is empty.</p>
            <a href="products.php" class="btn-primary">Browse collection</a>
        <?php else: ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($products as $product): ?>
                    <article class="border border-[#c9c7bd] bg-[#f5f2ea] p-4">
                        <a href="product.php?id=<?= (int) $product['id'] ?>">
                            <img src="<?= e(product_image_src($product)) ?>" alt="<?= e($product['title']) ?>" class="w-full aspect-[3/4] object-cover border border-[#c9c7bd]">
                        </a>
                        <h2 class="font-['Playfair_Display'] text-2xl mt-5"><?= e($product['title']) ?></h2>
                        <p class="text-[#474740] mt-1"><?= e(money_inr($product['price'])) ?></p>
                        <p class="text-sm text-[#78776f] mt-1"><?= (int) $product['stock'] > 0 ? (int) $product['stock'] . ' in stock' : 'Out of stock' ?></p>
                        <form method="POST" class="flex flex-wrap gap-3 mt-5">
                            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                            <button class="btn-primary" name="action" value="add_to_cart" type="submit" <?= (int) $product['stock'] <= 0 ? 'disabled' : '' ?>>Add to cart</button>
                            <button class="btn-secondary" name="action" value="remove" type="submit">Remove</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>
