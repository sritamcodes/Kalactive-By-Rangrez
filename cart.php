<?php
$pageTitle = 'Shopping Bag';
require_once __DIR__ . '/config/database.php';

$db = getDBConnection();

// Handle quantity updates or item removal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $id = (int)$_POST['product_id'];
        $qty = (int)$_POST['quantity'];
        if ($qty > 0) {
            $_SESSION['cart'][$id] = $qty;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'remove') {
        $id = (int)$_POST['product_id'];
        unset($_SESSION['cart'][$id]);
    }
}

$cartItems = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $productIds = array_keys($_SESSION['cart']);
    if (!empty($productIds)) {
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));
        $stmt = $db->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
        $stmt->execute($productIds);
        $products = $stmt->fetchAll();

        foreach ($products as $p) {
            $qty = $_SESSION['cart'][$p['id']];
            $subtotal = $p['price'] * $qty;
            $total += $subtotal;

            $cartItems[] = [
                'id' => $p['id'],
                'title' => $p['title'],
                'price' => $p['price'],
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <h1 class="font-headline-xl text-headline-xl text-on-background mb-8">YOUR CURATION BAG</h1>

    <?php if (empty($cartItems)): ?>
        <div class="text-center py-20 border border-outline-variant p-8 bg-primary-container card-shadow">
            <h2 class="font-headline-md text-headline-md text-on-background mb-4">Your bag is empty</h2>
            <p class="font-body-md text-on-surface-variant mb-6">Discover our royal edits and handcrafted objects for your sanctuary.</p>
            <a href="products.php" class="btn-primary">EXPLORE THE EDIT</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 border border-outline-variant p-6 bg-primary-container card-shadow">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-outline-variant font-label-sm text-label-sm uppercase tracking-widest text-primary">
                            <th class="pb-4">PIECE</th>
                            <th class="pb-4">PRICE</th>
                            <th class="pb-4">QTY</th>
                            <th class="pb-4">SUBTOTAL</th>
                            <th class="pb-4">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/60">
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td class="py-4 font-headline-md text-lg text-on-background"><?= sanitize($item['title']); ?></td>
                                <td class="py-4 font-body-md">₹<?= number_format($item['price'], 0); ?></td>
                                <td class="py-4">
                                    <form method="POST" action="cart.php" class="flex items-center space-x-2">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                                        <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1" class="w-16 bg-background border border-outline px-2 py-1 font-body-md text-center">
                                        <button type="submit" class="text-xs uppercase font-label-sm text-secondary hover:underline">Update</button>
                                    </form>
                                </td>
                                <td class="py-4 font-body-md font-semibold">₹<?= number_format($item['subtotal'], 0); ?></td>
                                <td class="py-4">
                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                                        <button type="submit" class="text-xs uppercase font-label-sm text-error hover:underline">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="border border-outline-variant p-6 bg-surface-container card-shadow h-fit">
                <h3 class="font-headline-md text-headline-md text-on-background mb-6">SUMMARY</h3>
                <div class="flex justify-between font-body-md mb-4 text-on-surface-variant">
                    <span>Subtotal</span>
                    <span>₹<?= number_format($total, 0); ?></span>
                </div>
                <div class="flex justify-between font-body-md mb-4 text-on-surface-variant">
                    <span>Complimentary Shipping</span>
                    <span class="text-secondary uppercase">Included</span>
                </div>
                <div class="w-full h-[1px] bg-outline-variant my-4"></div>
                <div class="flex justify-between font-headline-md text-headline-md text-on-background mb-8">
                    <span>Total</span>
                    <span>₹<?= number_format($total, 0); ?></span>
                </div>
                <a href="checkout.php" class="btn-primary w-full text-center">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
