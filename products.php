<?php
require_once __DIR__ . '/includes/product-functions.php';
$products = catalogue_products();
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased">
    <div class="texture-overlay"></div>
    <header class="border-b border-[#c9c7bd] bg-[#faf9f5]/95">
        <div class="max-w-[1440px] mx-auto px-5 md:px-16 py-5 flex items-center justify-between">
            <a href="index.php" class="font-['Playfair_Display'] text-2xl text-[#5f5e58]">कला'ctive</a>
            <nav class="flex items-center gap-6 text-xs uppercase tracking-widest text-[#5f5e58]">
                <a href="products.php" class="text-[#974724] border-b border-[#974724]">Collections</a>
                <a href="rooms.php" class="hover:text-[#974724]">Rooms</a>
                <a href="story.php" class="hover:text-[#974724]">Our Story</a>
                <a href="cart.php" class="hover:text-[#974724]">Cart</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="max-w-[1440px] mx-auto px-5 md:px-16 pt-20 pb-12">
            <p class="text-xs uppercase tracking-widest text-[#974724] mb-5">Collections</p>
            <div class="grid md:grid-cols-[0.8fr_1.2fr] gap-10 border-b border-[#c9c7bd] pb-12">
                <h1 class="font-['Playfair_Display'] text-4xl md:text-6xl leading-tight text-[#1b1c1a]">Objects for Indian homes</h1>
                <p class="text-[#474740] leading-7 max-w-xl md:pt-4">Browse the catalogue. Product names, prices, stock and images come directly from the store database.</p>
            </div>
        </section>

        <section class="max-w-[1440px] mx-auto px-5 md:px-16 pb-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($products as $product): ?>
                    <a href="product.php?id=<?= (int) $product['id'] ?>" class="group block border border-[#c9c7bd] bg-[#f5f2ea] p-4 transition-transform duration-300 hover:-translate-y-1">
                        <div class="aspect-[3/4] overflow-hidden border border-[#c9c7bd]/70 bg-[#efeeea]">
                            <img src="<?= htmlspecialchars(product_image_src($product)) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                        <div class="pt-5">
                            <p class="text-[11px] uppercase tracking-widest text-[#78776f] mb-2"><?= htmlspecialchars($product['category_name'] ?? 'Collection') ?></p>
                            <h2 class="font-['Playfair_Display'] text-2xl text-[#1b1c1a] group-hover:text-[#974724] group-hover:underline underline-offset-4 decoration-[#974724]"><?= htmlspecialchars($product['title']) ?></h2>
                            <p class="mt-2 text-[#474740]"><?= htmlspecialchars(money_inr($product['price'])) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
