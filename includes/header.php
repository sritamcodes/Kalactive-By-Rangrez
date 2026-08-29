<?php
require_once __DIR__ . '/../config/database.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$currentCategory = isset($_GET['category']) ? sanitize($_GET['category']) : '';
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? sanitize($pageTitle) . ' | KALATIVE - A CURATION BY RANGREZ' : 'KALATIVE - A CURATION BY RANGREZ'; ?></title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed": "#e5e2da",
                        "inverse-on-surface": "#f2f1ed",
                        "surface-container": "#efeeea",
                        "secondary-container": "#ff996f",
                        "surface-dim": "#dbdad6",
                        "primary-container": "#f5f2ea",
                        "on-secondary-fixed-variant": "#79300e",
                        "surface-container-high": "#e9e8e4",
                        "primary": "#5f5e58",
                        "background": "#faf9f5",
                        "surface-bright": "#faf9f5",
                        "surface-tint": "#5f5e58",
                        "surface-container-low": "#f4f4f0",
                        "on-tertiary-fixed-variant": "#474746",
                        "on-error-container": "#93000a",
                        "on-primary-fixed": "#1c1c17",
                        "on-primary-fixed-variant": "#474741",
                        "secondary": "#974724",
                        "on-secondary-fixed": "#370e00",
                        "tertiary-container": "#f4f1f1",
                        "outline-variant": "#c9c7bd",
                        "on-surface-variant": "#474740",
                        "on-primary": "#ffffff",
                        "on-secondary-container": "#772f0d",
                        "surface-variant": "#e3e2df",
                        "on-primary-container": "#6f6e68",
                        "on-error": "#ffffff",
                        "outline": "#78776f",
                        "secondary-fixed-dim": "#ffb598",
                        "tertiary": "#5f5e5e",
                        "surface-container-highest": "#e3e2df",
                        "tertiary-fixed": "#e5e2e1",
                        "on-secondary": "#ffffff",
                        "primary-fixed-dim": "#c9c6bf",
                        "inverse-primary": "#c9c6bf",
                        "inverse-surface": "#2f312e",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "surface": "#faf9f5",
                        "on-tertiary-fixed": "#1c1b1b",
                        "on-background": "#1b1c1a",
                        "secondary-fixed": "#ffdbce",
                        "on-tertiary-container": "#6f6e6d",
                        "tertiary-fixed-dim": "#c8c6c5",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "on-surface": "#1b1c1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "unit": "8px",
                        "gutter": "32px",
                        "margin-desktop": "64px",
                        "margin-mobile": "20px",
                        "section-gap": "120px",
                        "container-max": "1440px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Playfair Display"],
                        "headline-xl": ["Playfair Display"],
                        "headline-xl-mobile": ["Playfair Display"],
                        "body-md": ["Inter"],
                        "display-lg": ["Playfair Display"],
                        "label-sm": ["Inter"],
                        "headline-md": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"],
                        "body-lg": ["Inter"],
                        "label-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "headline-xl": ["48px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "headline-xl-mobile": ["32px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg": ["64px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-sm": ["12px", { "lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "500" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "500" }],
                        "display-lg-mobile": ["40px", { "lineHeight": "1.1", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "label-lg": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.1em", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden selection:bg-secondary-container selection:text-on-secondary-container">

<div class="texture-overlay"></div>

<!-- Top Sticky Navigation Bar -->
<nav class="sticky top-0 left-0 w-full flex flex-col justify-center bg-background/95 backdrop-blur border-b border-outline-variant/60 z-50 shadow-sm" id="main-nav">
    <div class="max-w-[1440px] mx-auto w-full px-margin-mobile md:px-margin-desktop py-4 flex items-center justify-between">
        <div class="hidden md:flex items-center space-x-8">
            <a class="<?= ($currentPage === 'products.php' && empty($currentCategory)) ? 'text-secondary border-b border-secondary font-semibold' : 'text-primary'; ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="products.php">SHOP</a>
            <a class="<?= ($currentCategory === 'royal-edit') ? 'text-secondary border-b border-secondary font-semibold' : 'text-primary'; ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="products.php?category=royal-edit">COLLECTIONS</a>
            <a class="<?= ($currentCategory === 'earthed') ? 'text-secondary border-b border-secondary font-semibold' : 'text-primary'; ?> font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="products.php?category=earthed">ROOMS</a>
            <a class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300" href="index.php#our-story">OUR STORY</a>
        </div>
        
        <a class="font-headline-lg text-headline-lg tracking-tighter text-primary hover:text-secondary transition-colors" href="index.php">कला'ctive</a>
        
        <div class="flex items-center space-x-6">
            <a class="text-primary hover:text-secondary transition-colors flex items-center" href="products.php" title="Wishlist">
                <span class="material-symbols-outlined">favorite</span>
            </a>
            
            <a class="text-primary hover:text-secondary transition-colors relative flex items-center" href="cart.php" title="Shopping Bag">
                <span class="material-symbols-outlined">shopping_bag</span>
                <?php if (getCartCount() > 0): ?>
                    <span class="absolute -top-2 -right-2 bg-secondary text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center"><?= getCartCount(); ?></span>
                <?php endif; ?>
            </a>
            
            <?php if (isLoggedIn()): ?>
                <?php if (isAdmin()): ?>
                    <a class="text-primary hover:text-secondary font-label-sm uppercase text-xs tracking-wider" href="admin/dashboard.php">Admin</a>
                <?php endif; ?>
                <a class="text-primary hover:text-secondary transition-colors flex items-center" href="logout.php" title="Logout">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            <?php else: ?>
                <a class="text-primary hover:text-secondary transition-colors flex items-center" href="login.php" title="Account">
                    <span class="material-symbols-outlined">person</span>
                </a>
            <?php endif; ?>

            <a class="md:hidden text-primary hover:text-secondary transition-colors" href="products.php">
                <span class="material-symbols-outlined">menu</span>
            </a>
        </div>
    </div>
</nav>
