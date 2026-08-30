<?php
require_once __DIR__ . '/session.php';

$navPrefix = $navPrefix ?? '';
$activePage = $activePage ?? '';
$user = current_user();
$cartCount = cart_count();
$accountLabel = $user ? strtoupper(first_name($user)) : 'LOGIN';
$accountHref = $user ? $navPrefix . 'logout.php' : $navPrefix . 'login.php';
$accountTitle = $user ? 'Logout' : 'Login';
?>
<nav class="kal-nav fixed top-0 left-0 w-full flex flex-col justify-center bg-transparent border-b border-transparent z-50 reveal-seq-3 revealed" id="main-nav">
    <div class="max-w-[1440px] mx-auto w-full px-margin-mobile md:px-margin-desktop py-4 flex items-center justify-between">
        <div class="hidden md:flex items-center space-x-8">
            <a class="<?= $activePage === 'shop' ? 'text-secondary border-b border-secondary opacity-80' : 'text-primary' ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="<?= e($navPrefix) ?>products.php">SHOP</a>
            <a class="<?= $activePage === 'collections' ? 'text-secondary border-b border-secondary opacity-80' : 'text-primary' ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="<?= e($navPrefix) ?>products.php">COLLECTIONS</a>
            <a class="<?= $activePage === 'rooms' ? 'text-secondary border-b border-secondary opacity-80' : 'text-primary' ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="<?= e($navPrefix) ?>rooms.php">ROOMS</a>
            <a class="<?= $activePage === 'story' ? 'text-secondary border-b border-secondary opacity-80' : 'text-primary' ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="<?= e($navPrefix) ?>story.php">OUR STORY</a>
        </div>
        <a class="font-headline-lg text-headline-lg tracking-tighter text-primary" href="<?= e($navPrefix) ?>index.php">कला'ctive</a>
        <div class="flex items-center space-x-5">
            <a href="<?= e($navPrefix) ?>wishlist.php" class="text-primary hover:text-secondary transition-colors nav-icon-link" aria-label="Wishlist"><span class="material-symbols-outlined">favorite</span></a>
            <a href="<?= e($navPrefix) ?>cart.php" class="text-primary hover:text-secondary transition-colors nav-icon-link" aria-label="Shopping cart"><span class="material-symbols-outlined">shopping_bag</span><?php if ($cartCount > 0): ?><span class="nav-count"><?= (int) $cartCount ?></span><?php endif; ?></a>
            <a href="<?= e($accountHref) ?>" class="hidden sm:inline-flex text-primary hover:text-secondary transition-colors text-xs uppercase tracking-widest" aria-label="<?= e($accountTitle) ?>"><?= e($accountLabel) ?></a>
            <button type="button" class="md:hidden text-primary hover:text-secondary transition-colors mobile-menu-button" aria-label="Open menu" aria-expanded="false" data-mobile-menu-button>
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    <div class="mobile-nav-panel" data-mobile-menu>
        <a href="<?= e($navPrefix) ?>products.php">SHOP</a>
        <a href="<?= e($navPrefix) ?>products.php">COLLECTIONS</a>
        <a href="<?= e($navPrefix) ?>rooms.php">ROOMS</a>
        <a href="<?= e($navPrefix) ?>story.php">OUR STORY</a>
        <a href="<?= e($user ? $navPrefix . 'logout.php' : $navPrefix . 'login.php') ?>"><?= e($user ? 'LOGOUT' : 'LOGIN / ACCOUNT') ?></a>
        <a href="<?= e($navPrefix) ?>wishlist.php">WISHLIST</a>
        <a href="<?= e($navPrefix) ?>cart.php">CART<?= $cartCount > 0 ? ' (' . (int) $cartCount . ')' : '' ?></a>
    </div>
</nav>
