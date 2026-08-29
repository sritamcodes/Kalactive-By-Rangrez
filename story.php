<?php
require_once __DIR__ . '/config/database.php';
session_start();

$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cartCount = array_sum($_SESSION['cart']);
}
?>
<!doctype html>
<html class="scroll-smooth" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Our Story | KALATIVE - Curated by Rangrez</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Playfair+Display:wght@500;600;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-fixed": "#e5e2da",
              "inverse-on-surface": "#f2f1ed",
              "surface-container": "#efeeea",
              "secondary-container": "#ff996f",
              "surface-dim": "#dbdad6",
              "primary-container": "#f5f2ea",
              "on-secondary-fixed-variant": "#79300e",
              "surface-container-high": "#e9e8e4",
              primary: "#5f5e58",
              background: "#faf9f5",
              "surface-bright": "#faf9f5",
              "surface-tint": "#5f5e58",
              "surface-container-low": "#f4f4f0",
              "on-tertiary-fixed-variant": "#474746",
              "on-error-container": "#93000a",
              "on-primary-fixed": "#1c1c17",
              "on-primary-fixed-variant": "#474741",
              secondary: "#974724",
              "on-secondary-fixed": "#370e00",
              "tertiary-container": "#f4f1f1",
              "outline-variant": "#c9c7bd",
              "on-surface-variant": "#474740",
              "on-primary": "#ffffff",
              "on-secondary-container": "#772f0d",
              "surface-variant": "#e3e2df",
              "on-primary-container": "#6f6e68",
              "on-error": "#ffffff",
              outline: "#78776f",
              "secondary-fixed-dim": "#ffb598",
              tertiary: "#5f5e5e",
              "surface-container-highest": "#e3e2df",
              "tertiary-fixed": "#e5e2e1",
              "on-secondary": "#ffffff",
              "primary-fixed-dim": "#c9c6bf",
              "inverse-primary": "#c9c6bf",
              "inverse-surface": "#2f312e",
              "surface-container-lowest": "#ffffff",
              error: "#ba1a1a",
              surface: "#faf9f5",
              "on-tertiary-fixed": "#1c1b1b",
              "on-background": "#1b1c1a",
              "secondary-fixed": "#ffdbce",
              "on-tertiary-container": "#6f6e6d",
              "tertiary-fixed-dim": "#c8c6c5",
              "error-container": "#ffdad6",
              "on-tertiary": "#ffffff",
              "on-surface": "#1b1c1a",
            },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
            spacing: {
              unit: "8px",
              gutter: "32px",
              "margin-desktop": "64px",
              "margin-mobile": "20px",
              "section-gap": "120px",
              "container-max": "1440px",
            },
            fontFamily: {
              "headline-lg": ["Playfair Display", "serif"],
              "headline-xl": ["Playfair Display", "serif"],
              "headline-xl-mobile": ["Playfair Display", "serif"],
              "body-md": ["Inter", "sans-serif"],
              "display-lg": ["Playfair Display", "serif"],
              "label-sm": ["Inter", "sans-serif"],
              "headline-md": ["Playfair Display", "serif"],
              "display-lg-mobile": ["Playfair Display", "serif"],
              "body-lg": ["Inter", "sans-serif"],
              "label-lg": ["Inter", "sans-serif"],
            },
            fontSize: {
              "headline-lg": ["32px", { lineHeight: "1.3", fontWeight: "600" }],
              "headline-xl": ["48px", { lineHeight: "1.2", fontWeight: "600" }],
              "headline-xl-mobile": [
                "32px",
                { lineHeight: "1.2", fontWeight: "600" },
              ],
              "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
              "display-lg": [
                "64px",
                {
                  lineHeight: "1.1",
                  letterSpacing: "-0.02em",
                  fontWeight: "700",
                },
              ],
              "label-sm": [
                "12px",
                {
                  lineHeight: "1.2",
                  letterSpacing: "0.05em",
                  fontWeight: "500",
                },
              ],
              "headline-md": ["24px", { lineHeight: "1.4", fontWeight: "500" }],
              "display-lg-mobile": [
                "40px",
                { lineHeight: "1.1", fontWeight: "700" },
              ],
              "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
              "label-lg": [
                "14px",
                {
                  lineHeight: "1.2",
                  letterSpacing: "0.1em",
                  fontWeight: "600",
                },
              ],
            },
          },
        },
      };
    </script>
    <style>
      .texture-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 9999;
        opacity: 0.2;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        mix-blend-mode: multiply;
      }

      .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        background-color: #1b1c1a;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: all 0.3s ease;
        border-radius: 0;
      }
      .btn-primary:hover {
        background-color: #5f5e58;
      }

      .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        border: 1px solid #78776f;
        color: #5f5e58;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: all 0.3s ease;
        border-radius: 0;
        box-shadow: 2px 2px 0px rgba(26,26,26,0.1);
      }
      .btn-secondary:hover {
        background-color: #efeeea;
      }

      .card-shadow {
        box-shadow: 4px 4px 0px rgba(26, 26, 26, 0.05);
      }

      nav.scrolled {
        background-color: #faf9f5 !important;
        border-bottom-color: #c9c7bd !important;
      }
    </style>
  </head>
  <body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden selection:bg-secondary-container">
    <div class="texture-overlay"></div>

    <!-- TopNavBar -->
    <nav
      class="fixed top-0 left-0 w-full flex flex-col justify-center bg-background/90 backdrop-blur border-b border-outline-variant/60 docked full-width z-50 transition-all duration-300"
      id="main-nav"
    >
      <div
        class="max-w-[1440px] mx-auto w-full px-margin-mobile md:px-margin-desktop py-4 flex items-center justify-between"
      >
        <div class="hidden md:flex items-center space-x-8">
          <a
            class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300"
            href="products.php"
            >SHOP</a
          >
          <a
            class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300"
            href="products.php"
            >COLLECTIONS</a
          >
          <a
            class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300"
            href="index.php#moods"
            >ROOMS</a
          >
          <a
            class="text-secondary border-b border-secondary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300 opacity-90"
            href="story.php"
            >OUR STORY</a
          >
        </div>
        <a
          class="font-headline-lg text-headline-lg tracking-tighter text-primary"
          href="index.php"
          >कला'ctive</a
        >
        <div class="flex items-center space-x-6">
          <a href="products.php" class="text-primary hover:text-secondary transition-colors" title="Wishlist">
            <span class="material-symbols-outlined">favorite</span>
          </a>
          <a href="cart.php" class="text-primary hover:text-secondary transition-colors relative" title="Shopping Bag">
            <span class="material-symbols-outlined">shopping_bag</span>
            <?php if ($cartCount > 0): ?>
              <span class="absolute -top-1 -right-2 bg-secondary text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold"><?= $cartCount ?></span>
            <?php endif; ?>
          </a>
          <a href="<?= isset($_SESSION['user_id']) ? 'logout.php' : 'login.php' ?>" class="text-primary hover:text-secondary transition-colors" title="<?= isset($_SESSION['user_id']) ? 'Sign Out' : 'Sign In' ?>">
            <span class="material-symbols-outlined">person</span>
          </a>
          <button
            class="md:hidden text-primary hover:text-secondary transition-colors"
            onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
          >
            <span class="material-symbols-outlined">menu</span>
          </button>
        </div>
      </div>

      <!-- Mobile Menu Dropdown -->
      <div id="mobile-menu" class="hidden md:hidden bg-background border-b border-outline-variant px-6 py-4 space-y-3">
        <a class="block font-label-lg text-label-lg uppercase tracking-widest text-primary" href="products.php">SHOP</a>
        <a class="block font-label-lg text-label-lg uppercase tracking-widest text-primary" href="products.php">COLLECTIONS</a>
        <a class="block font-label-lg text-label-lg uppercase tracking-widest text-primary" href="index.php#moods">ROOMS</a>
        <a class="block font-label-lg text-label-lg uppercase tracking-widest text-secondary font-semibold" href="story.php">OUR STORY</a>
      </div>
    </nav>

    <main class="pt-24">
      <!-- 1. Hero Story Banner -->
      <section class="relative w-full h-[65vh] min-h-[480px] max-h-[700px] overflow-hidden flex items-center justify-center bg-primary-container">
        <img
          src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1920&q=85"
          alt="Ancient Rajasthani Haveli Architecture"
          class="absolute inset-0 w-full h-full object-cover filter brightness-[0.85]"
        />
        <div class="absolute inset-0 bg-background/25 mix-blend-multiply"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
          <p class="font-label-sm text-xs uppercase tracking-[0.3em] text-[#ffdbce] mb-4">The Rangrez Narrative</p>
          <h1 class="font-headline-xl text-3xl md:text-5xl lg:text-6xl text-white font-serif mb-6 leading-tight">
            The Soul of Imperial Craftsmanship Reimagined
          </h1>
          <p class="font-body-lg text-sm md:text-base text-[#f5f2ea] max-w-2xl mx-auto leading-relaxed">
            A celebration of ancestral techniques, organic mineral weights, and the quiet dignity of handmade Indian living.
          </p>
        </div>
      </section>

      <!-- 2. Statement Section -->
      <section class="py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center">
        <span class="font-label-sm text-xs uppercase tracking-widest text-secondary block mb-3">Our Ethos</span>
        <h2 class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary mb-8 max-w-4xl mx-auto leading-snug">
          "WE DO NOT MASS PRODUCE OBJECTS.<br>WE CURATE LIVING STORIES."
        </h2>
        <div class="w-24 h-[1px] bg-secondary mx-auto mb-8"></div>
        <p class="font-body-lg text-lg text-on-surface-variant max-w-3xl mx-auto leading-relaxed">
          KALATIVE was conceived by the house of <strong>Rangrez</strong> to bridge the timeless romance of Rajasthani royal courts with the serene restraint of modern architecture. Each piece in our collection is an intentional, slow-crafted testament to centuries of passed-down mastery.
        </p>
      </section>

      <!-- 3. Chapter 1: The Genesis -->
      <section class="py-20 bg-surface-container-low border-t border-b border-outline-variant">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left Frame -->
            <div class="relative">
              <div class="aspect-[4/5] border border-outline-variant p-3 bg-primary-container card-shadow">
                <img
                  src="https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=80"
                  alt="Artisan shaping raw terracotta pottery"
                  class="w-full h-full object-cover"
                />
              </div>
              <div class="absolute -bottom-6 -right-6 w-40 h-40 border border-secondary opacity-30 hidden md:block"></div>
            </div>

            <!-- Right Narrative -->
            <div>
              <span class="font-label-sm text-xs uppercase tracking-widest text-secondary mb-2 block">Chapter I</span>
              <h3 class="font-headline-xl text-3xl md:text-4xl text-on-background mb-6">Born from the Sacred Earth of Rajasthan</h3>
              <div class="w-16 h-[1px] bg-secondary mb-6"></div>
              <p class="font-body-lg text-base text-on-surface-variant mb-6 leading-relaxed">
                Our journey begins in the historic artisan clusters of Jaipur, Jodhpur, and the desert borders of Pokhran. Here, master potters, metalworkers, and stone carvers practice guild arts that have remained unchanged for over four centuries.
              </p>
              <p class="font-body-lg text-base text-on-surface-variant mb-8 leading-relaxed">
                By honoring the natural rhythms of clay drying under the desert sun, the slow rhythm of hand-hammered raw brass, and the precision of sandstone chisel carving, we preserve a tangible human connection in every creation.
              </p>
              <div class="grid grid-cols-2 gap-6 pt-4 border-t border-outline-variant/60">
                <div>
                  <h4 class="font-headline-md text-xl text-primary font-semibold">100% Organic</h4>
                  <p class="font-body-md text-xs text-on-surface-variant">Naturally sourced riverbed clays & non-toxic vegetable dyes.</p>
                </div>
                <div>
                  <h4 class="font-headline-md text-xl text-primary font-semibold">Slow-Made</h4>
                  <p class="font-body-md text-xs text-on-surface-variant">Each individual vessel takes up to 21 days of meticulous craft.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 4. Four Guild Pillars -->
      <section class="py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="text-center mb-16">
          <span class="font-label-sm text-xs uppercase tracking-widest text-secondary block mb-2">The Four Guilds</span>
          <h2 class="font-headline-lg text-3xl md:text-4xl text-on-background mb-4">Our Craft Disciplines</h2>
          <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto">
            Explore the four foundational materials that define the tactile sanctuary of KALATIVE.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Guild 1 -->
          <div class="border border-outline-variant bg-primary-container p-6 card-shadow text-center flex flex-col justify-between">
            <div>
              <div class="aspect-square overflow-hidden mb-6 border border-outline-variant/60">
                <img src="https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=600&q=80" alt="Ceramic Stoneware" class="w-full h-full object-cover">
              </div>
              <h3 class="font-headline-md text-xl text-on-background mb-2">I. The Clay Guild</h3>
              <p class="font-body-md text-xs text-on-surface-variant leading-relaxed mb-6">
                Wabi-sabi stoneware, terracotta vessels, and organic mineral glazes fired in wood-fueled traditional kilns.
              </p>
            </div>
            <a href="products.php?cat=ceramic-objects" class="text-xs font-label-sm uppercase tracking-widest text-secondary hover:underline">Explore Ceramics &rarr;</a>
          </div>

          <!-- Guild 2 -->
          <div class="border border-outline-variant bg-primary-container p-6 card-shadow text-center flex flex-col justify-between">
            <div>
              <div class="aspect-square overflow-hidden mb-6 border border-outline-variant/60">
                <img src="https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=600&q=80" alt="Brass & Lighting" class="w-full h-full object-cover">
              </div>
              <h3 class="font-headline-md text-xl text-on-background mb-2">II. The Brass Guild</h3>
              <p class="font-body-md text-xs text-on-surface-variant leading-relaxed mb-6">
                Spun, cast, and hand-chiseled raw brass lamps and oxidized urlis celebrating warm golden ambient light.
              </p>
            </div>
            <a href="products.php?cat=heritage-lighting" class="text-xs font-label-sm uppercase tracking-widest text-secondary hover:underline">Explore Lighting &rarr;</a>
          </div>

          <!-- Guild 3 -->
          <div class="border border-outline-variant bg-primary-container p-6 card-shadow text-center flex flex-col justify-between">
            <div>
              <div class="aspect-square overflow-hidden mb-6 border border-outline-variant/60">
                <img src="https://images.unsplash.com/photo-1618221381711-42ca8ab6e908?auto=format&fit=crop&w=600&q=80" alt="Architectural Mirrors" class="w-full h-full object-cover">
              </div>
              <h3 class="font-headline-md text-xl text-on-background mb-2">III. The Iron & Stone</h3>
              <p class="font-body-md text-xs text-on-surface-variant leading-relaxed mb-6">
                Hand-forged iron arches, Jharokha stone relief carvings, and monolithic sandstone furniture blocks.
              </p>
            </div>
            <a href="products.php?cat=architectural-mirrors" class="text-xs font-label-sm uppercase tracking-widest text-secondary hover:underline">Explore Mirrors &rarr;</a>
          </div>

          <!-- Guild 4 -->
          <div class="border border-outline-variant bg-primary-container p-6 card-shadow text-center flex flex-col justify-between">
            <div>
              <div class="aspect-square overflow-hidden mb-6 border border-outline-variant/60">
                <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=600&q=80" alt="Handloom Weaving" class="w-full h-full object-cover">
              </div>
              <h3 class="font-headline-md text-xl text-on-background mb-2">IV. The Weave Guild</h3>
              <p class="font-body-md text-xs text-on-surface-variant leading-relaxed mb-6">
                Pure wool and organic cotton flatweave dhurries dyed with natural pomegranate peel, indigo, and madder root.
              </p>
            </div>
            <a href="products.php?cat=royal-living" class="text-xs font-label-sm uppercase tracking-widest text-secondary hover:underline">Explore Living &rarr;</a>
          </div>
        </div>
      </section>

      <!-- 5. Artisanal Commitments -->
      <section class="py-20 bg-surface-container border-t border-b border-outline-variant">
        <div class="max-w-4xl mx-auto px-6 text-center">
          <span class="font-label-sm text-xs uppercase tracking-widest text-secondary block mb-2">Our Guarantees</span>
          <h2 class="font-headline-xl text-3xl md:text-4xl text-on-background mb-10">The Rangrez Guild Covenant</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="bg-background p-6 border border-outline-variant">
              <span class="material-symbols-outlined text-secondary text-2xl mb-2">workspace_premium</span>
              <h4 class="font-headline-md text-lg text-primary mb-2">Lineage Provenance</h4>
              <p class="font-body-md text-xs text-on-surface-variant">Every creation is signed and numbered by the lead master artisan.</p>
            </div>
            <div class="bg-background p-6 border border-outline-variant">
              <span class="material-symbols-outlined text-secondary text-2xl mb-2">volunteer_activism</span>
              <h4 class="font-headline-md text-lg text-primary mb-2">Fair Trade Artisans</h4>
              <p class="font-body-md text-xs text-on-surface-variant">Direct profit sharing with craft communities across 8 desert villages.</p>
            </div>
            <div class="bg-background p-6 border border-outline-variant">
              <span class="material-symbols-outlined text-secondary text-2xl mb-2">all_inclusive</span>
              <h4 class="font-headline-md text-lg text-primary mb-2">Lifetime Heirlooms</h4>
              <p class="font-body-md text-xs text-on-surface-variant">Objects engineered to gain rich patina and age gracefully through generations.</p>
            </div>
          </div>

          <div class="mt-12">
            <a href="products.php" class="btn-primary">Browse The Complete Collection &rarr;</a>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer - Exactly Matching Home Page -->
    <footer
      class="w-full py-section-gap px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container border-t bg-surface-container-high full-width bottom-0"
    >
      <div class="md:col-span-1 flex flex-col items-start">
        <a class="font-display-lg text-display-lg text-primary mb-8" href="index.php"
          >KALATIVE</a
        >
        <p
          class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant"
        >
          CURATED BY RANGREZ.
        </p>
      </div>
      <div class="md:col-span-3 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="flex flex-col space-y-4">
          <a
            class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
            href="products.php"
            >SHOP</a
          >
          <a
            class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
            href="products.php"
            >COLLECTIONS</a
          >
          <a
            class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
            href="story.php"
            >OUR STORY</a
          >
        </div>
        <div class="flex flex-col space-y-4">
          <a
            class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
            href="#"
            >HELP</a
          >
          <a
            class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
            href="#"
            >CONTACT</a
          >
        </div>
        <div class="col-span-2 md:col-span-2">
          <p
            class="font-label-sm text-label-sm uppercase tracking-widest text-primary mb-4"
          >
            JOIN THE NARRATIVE
          </p>
          <form class="flex items-end max-w-sm" onsubmit="event.preventDefault(); alert('Thank you for joining the narrative.');">
            <div class="relative w-full">
              <label
                class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant absolute -top-5 left-0"
                for="email"
                >EMAIL ADDRESS</label
              >
              <input
                class="w-full bg-transparent border-0 border-b border-outline-variant focus:border-secondary focus:ring-0 px-0 py-2 font-body-md text-on-background placeholder-on-surface-variant/50 transition-colors"
                id="email"
                placeholder="Enter your email"
                type="email"
                required
              />
            </div>
            <button
              class="ml-4 text-secondary hover:text-primary transition-colors"
              type="submit"
              aria-label="Subscribe"
            >
              <span class="material-symbols-outlined">arrow_forward</span>
            </button>
          </form>
        </div>
      </div>
    </footer>

    <script>
      const nav = document.getElementById("main-nav");
      window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
          nav.classList.add("scrolled");
        } else {
          nav.classList.remove("scrolled");
        }
      });
    </script>
  </body>
</html>
