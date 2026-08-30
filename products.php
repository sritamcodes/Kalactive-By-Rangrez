<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';
$products = catalogue_products();
$activePage = 'collections';
$likedProductIds = is_logged_in() ? wishlist_product_ids((int) current_user()['id']) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections | Kalactive</title>
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

    <main>
        <section class="max-w-[1440px] mx-auto px-5 md:px-16 pt-32 pb-12">
            <p class="text-xs uppercase tracking-widest text-[#974724] mb-5">Collections</p>
            <div class="grid md:grid-cols-[0.8fr_1.2fr] gap-10 border-b border-[#c9c7bd] pb-12">
                <h1 class="font-['Playfair_Display'] text-4xl md:text-6xl leading-tight text-[#1b1c1a]">Objects for Indian homes</h1>
                <p class="text-[#474740] leading-7 max-w-xl md:pt-4">Browse the catalogue. Product names, prices, stock and images come directly from the store database.</p>
            </div>
        </section>

        <section class="max-w-[1440px] mx-auto px-5 md:px-16 pb-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($products as $product): ?>
                    <article class="group border border-[#c9c7bd] bg-[#f5f2ea] p-4 transition-transform duration-300 hover:-translate-y-1 relative">
                        <form method="POST" action="wishlist-toggle.php" class="absolute top-6 right-6 z-10">
                            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                            <input type="hidden" name="redirect" value="products.php">
                            <button type="submit" class="bg-[#faf9f5]/90 border border-[#c9c7bd] w-10 h-10 inline-flex items-center justify-center text-[#974724]" aria-label="Toggle wishlist">
                                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' <?= in_array((int) $product['id'], $likedProductIds, true) ? '1' : '0' ?>">favorite</span>
                            </button>
                        </form>
                        <a href="product.php?id=<?= (int) $product['id'] ?>" class="block">
                        <div class="aspect-[3/4] overflow-hidden border border-[#c9c7bd]/70 bg-[#efeeea]">
                            <img src="<?= htmlspecialchars(product_image_src($product)) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                        <div class="pt-5">
                            <p class="text-[11px] uppercase tracking-widest text-[#78776f] mb-2"><?= htmlspecialchars($product['category_name'] ?? 'Collection') ?></p>
                            <h2 class="font-['Playfair_Display'] text-2xl text-[#1b1c1a] group-hover:text-[#974724] group-hover:underline underline-offset-4 decoration-[#974724]"><?= htmlspecialchars($product['title']) ?></h2>
                            <p class="mt-2 text-[#474740]"><?= htmlspecialchars(money_inr($product['price'])) ?></p>
                        </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
