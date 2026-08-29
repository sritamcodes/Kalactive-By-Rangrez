<?php
$pageTitle = 'The Curation Catalog';
require_once __DIR__ . '/config/database.php';

$db = getDBConnection();

$categorySlug = isset($_GET['category']) ? sanitize($_GET['category']) : '';
$searchQuery = isset($_GET['q']) ? sanitize($_GET['q']) : '';

// Base Query
$sql = "SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p JOIN categories c ON p.category_id = c.id WHERE 1=1";
$params = [];

if (!empty($categorySlug)) {
    $sql .= " AND c.slug = ?";
    $params[] = $categorySlug;
}

if (!empty($searchQuery)) {
    $sql .= " AND (p.title LIKE ? OR p.description LIKE ?)";
    $params[] = "%$searchQuery%";
    $params[] = "%$searchQuery%";
}

$sql .= " ORDER BY p.created_at DESC";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Fetch categories for filter
$catStmt = $db->query("SELECT * FROM categories ORDER BY id ASC");
$categories = $catStmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 pb-8 border-b border-outline-variant gap-6">
        <div>
            <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">
                <?= !empty($categorySlug) ? strtoupper(str_replace('-', ' ', $categorySlug)) : 'ALL PIECES'; ?>
            </h1>
            <p class="font-body-md text-on-surface-variant"><?= count($products); ?> objects curated for quiet luxury</p>
        </div>

        <form action="products.php" method="GET" class="flex items-center space-x-2 w-full md:w-auto">
            <?php if (!empty($categorySlug)): ?>
                <input type="hidden" name="category" value="<?= $categorySlug; ?>">
            <?php endif; ?>
            <input type="text" name="q" class="bg-transparent border-0 border-b border-outline-variant focus:border-secondary focus:ring-0 px-0 py-2 font-body-md text-on-background placeholder-on-surface-variant/50 w-full md:w-64" placeholder="Search collection..." value="<?= $searchQuery; ?>">
            <button type="submit" class="text-secondary hover:text-primary transition-colors">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Category Filter -->
        <div class="lg:col-span-1 border border-outline-variant p-6 bg-primary-container h-fit card-shadow">
            <h3 class="font-label-lg text-label-lg uppercase tracking-widest text-primary mb-6">MOODS & COLLECTIONS</h3>
            <ul class="space-y-4">
                <li>
                    <a href="products.php" class="font-body-md <?= empty($categorySlug) ? 'text-secondary font-semibold border-b border-secondary' : 'text-on-surface-variant hover:text-secondary'; ?> block transition-colors">
                        ALL OBJECTS
                    </a>
                </li>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <a href="products.php?category=<?= $cat['slug']; ?>" class="font-body-md <?= $categorySlug === $cat['slug'] ? 'text-secondary font-semibold border-b border-secondary' : 'text-on-surface-variant hover:text-secondary'; ?> block transition-colors uppercase">
                            <?= sanitize($cat['name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Product Grid -->
        <div class="lg:col-span-3">
            <?php if (empty($products)): ?>
                <div class="text-center py-20 border border-outline-variant p-8 bg-primary-container card-shadow">
                    <h3 class="font-headline-md text-headline-md text-on-background mb-4">No pieces found</h3>
                    <p class="font-body-md text-on-surface-variant mb-6">Try adjusting your search query or filters.</p>
                    <a href="products.php" class="btn-secondary">RESET FILTERS</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($products as $product): ?>
                        <a class="group block border border-outline-variant p-4 bg-primary-container card-shadow transition-transform hover:-translate-y-1 duration-300 relative" href="product-detail.php?id=<?= $product['id']; ?>">
                            <div class="aspect-[3/4] mb-6 overflow-hidden relative border border-outline-variant/50">
                                <img alt="<?= sanitize($product['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="<?= sanitize($product['image']); ?>">
                                
                                <?php if (!empty($product['badge'])): ?>
                                    <span class="absolute top-2 right-2 border border-outline bg-background/90 backdrop-blur px-2 py-1 font-label-sm text-label-sm uppercase text-primary"><?= sanitize($product['badge']); ?></span>
                                <?php endif; ?>

                                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="bg-background/90 backdrop-blur px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest text-primary border border-outline transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">VIEW PIECE</span>
                                </div>
                            </div>

                            <div class="text-center">
                                <h3 class="font-headline-md text-headline-md text-on-background mb-2 group-hover:text-secondary transition-colors"><?= sanitize($product['title']); ?></h3>
                                <p class="font-body-md text-body-md text-on-surface-variant">From ₹<?= number_format($product['price'], 0); ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
