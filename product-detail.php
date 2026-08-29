<?php
require_once __DIR__ . '/config/database.php';

$db = getDBConnection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $db->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: products.php");
    exit();
}

$pageTitle = $product['title'];

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    if ($qty < 1) $qty = 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }

    $message = "Added {$qty} piece(s) to your curation bag.";
}

include __DIR__ . '/includes/header.php';
?>

<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <?php if (!empty($message)): ?>
        <div class="mb-8 p-4 border border-secondary bg-primary-container text-secondary flex justify-between items-center card-shadow">
            <span class="font-body-md"><?= $message; ?></span>
            <a href="cart.php" class="btn-primary py-2 px-4 text-xs">VIEW BAG &rarr;</a>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Image Preview -->
        <div class="border border-outline-variant p-4 bg-primary-container card-shadow relative">
            <div class="aspect-[3/4] overflow-hidden relative border border-outline-variant/50">
                <img alt="<?= sanitize($product['title']); ?>" class="w-full h-full object-cover" src="<?= sanitize($product['image']); ?>">
                <?php if (!empty($product['badge'])): ?>
                    <span class="absolute top-4 right-4 border border-outline bg-background/90 backdrop-blur px-3 py-1 font-label-sm text-label-sm uppercase text-primary"><?= sanitize($product['badge']); ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Specs & Purchase Action -->
        <div class="flex flex-col justify-center">
            <p class="font-label-sm text-label-sm uppercase tracking-widest text-secondary mb-3"><?= sanitize($product['category_name']); ?></p>
            <h1 class="font-headline-xl text-headline-xl text-on-background mb-4"><?= sanitize($product['title']); ?></h1>
            
            <p class="font-headline-lg text-headline-lg text-primary mb-6">₹<?= number_format($product['price'], 0); ?></p>
            
            <div class="w-16 h-[1px] bg-outline-variant mb-6"></div>
            
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 leading-relaxed">
                <?= nl2br(sanitize($product['description'])); ?>
            </p>

            <div class="mb-8 font-label-sm text-label-sm uppercase tracking-widest text-primary">
                AVAILABILITY: 
                <?php if ($product['stock'] > 0): ?>
                    <span class="text-secondary">IN STOCK (<?= $product['stock']; ?> PIECES)</span>
                <?php else: ?>
                    <span class="text-error">SOLD OUT</span>
                <?php endif; ?>
            </div>

            <?php if ($product['stock'] > 0): ?>
                <form method="POST" action="product-detail.php?id=<?= $product['id']; ?>" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex items-center border border-outline bg-background">
                        <button type="button" class="qty-btn-minus px-4 py-4 text-primary hover:text-secondary font-bold">-</button>
                        <input type="number" name="quantity" class="qty-input w-12 text-center border-0 bg-transparent font-body-md font-bold focus:ring-0" value="1" min="1" max="<?= $product['stock']; ?>">
                        <button type="button" class="qty-btn-plus px-4 py-4 text-primary hover:text-secondary font-bold">+</button>
                    </div>

                    <button type="submit" name="add_to_cart" class="btn-primary flex-1">
                        ADD TO CURATION BAG
                    </button>
                </form>
            <?php else: ?>
                <button disabled class="btn-secondary opacity-50 cursor-not-allowed w-full">
                    SOLD OUT
                </button>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
