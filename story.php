<?php
$pageTitle = "Our Story — KALACTIVE";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Tailwind CDN - keeping compatibility with the existing project -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL@0..1&display=swap"
        rel="stylesheet"
    >

    <!-- Existing stylesheet -->
    <link rel="stylesheet" href="css/style.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: "#faf9f5",
                        parchment: "#f5f2ea",
                        charcoal: "#1b1c1a",
                        terracotta: "#974724",
                        sandstone: "#d8c4aa",
                        brass: "#ad8a55",
                        muted: "#6f6e68"
                    },
                    fontFamily: {
                        display: ["Playfair Display", "serif"],
                        sans: ["Inter", "sans-serif"]
                    }
                }
            }
        };
    </script>

    <style>
        /* =====================================================
           STORY PAGE ONLY
           ===================================================== */

        .story-page {
            background: #faf9f5;
            color: #1b1c1a;
        }

        .story-hero {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 80% 20%, rgba(151, 71, 36, 0.08), transparent 35%),
                #f5f2ea;
        }

        .story-hero-image {
            filter: saturate(0.82) contrast(0.95);
        }

        .story-overlay {
            background:
                linear-gradient(
                    90deg,
                    rgba(20, 16, 12, 0.68) 0%,
                    rgba(20, 16, 12, 0.35) 42%,
                    rgba(20, 16, 12, 0.04) 75%
                );
        }

        .story-label {
            letter-spacing: 0.28em;
        }

        .story-ornament {
            position: relative;
        }

        .story-ornament::before,
        .story-ornament::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 80px;
            height: 1px;
            background: #974724;
            opacity: 0.45;
        }

        .story-ornament::before {
            right: calc(100% + 24px);
        }

        .story-ornament::after {
            left: calc(100% + 24px);
        }

        .story-quote {
            font-family: "Playfair Display", serif;
            line-height: 1.12;
        }

        .story-frame {
            box-shadow: 8px 8px 0 rgba(27, 28, 26, 0.07);
        }

        .story-image {
            transition: transform 900ms cubic-bezier(0.16, 1, 0.3, 1);
        }

        .story-image-wrap:hover .story-image {
            transform: scale(1.035);
        }

        .story-number {
            font-family: "Playfair Display", serif;
            color: rgba(151, 71, 36, 0.32);
        }

        .story-rule {
            height: 1px;
            background: #c9c7bd;
        }

        .story-pill {
            border: 1px solid rgba(151, 71, 36, 0.45);
            color: #974724;
            letter-spacing: 0.18em;
        }

        .story-footer-cta {
            background:
                linear-gradient(
                    135deg,
                    rgba(151, 71, 36, 0.96),
                    rgba(125, 52, 25, 0.98)
                );
        }

        @media (max-width: 768px) {
            .story-overlay {
                background:
                    linear-gradient(
                        180deg,
                        rgba(20, 16, 12, 0.24),
                        rgba(20, 16, 12, 0.76)
                    );
            }

            .story-ornament::before,
            .story-ornament::after {
                width: 32px;
            }

            .story-ornament::before {
                right: calc(100% + 10px);
            }

            .story-ornament::after {
                left: calc(100% + 10px);
            }
        }
    </style>
</head>

<body class="story-page overflow-x-hidden antialiased">

    <!-- Existing texture treatment -->
    <div class="texture-overlay"></div>

    <!-- =====================================================
         NAVIGATION
         ===================================================== -->

    <nav
        id="main-nav"
        class="fixed top-0 left-0 w-full z-50 bg-transparent border-b border-transparent transition-all duration-500"
    >
        <div class="max-w-[1440px] mx-auto px-5 md:px-16 py-4 flex items-center justify-between">

            <!-- Left -->
            <div class="hidden md:flex items-center gap-8">

                <a
                    href="products.php"
                    class="text-sm uppercase tracking-[0.18em] text-[#1b1c1a] hover:text-[#974724] transition-colors"
                >
                    SHOP
                </a>

                <a
                    href="products.php"
                    class="text-sm uppercase tracking-[0.18em] text-[#1b1c1a] hover:text-[#974724] transition-colors"
                >
                    COLLECTIONS
                </a>

                <a
                    href="rooms.php"
                    class="text-sm uppercase tracking-[0.18em] text-[#1b1c1a] hover:text-[#974724] transition-colors"
                >
                    ROOMS
                </a>

                <a
                    href="story.php"
                    class="text-sm uppercase tracking-[0.18em] text-[#974724] border-b border-[#974724] pb-1"
                >
                    OUR STORY
                </a>

            </div>

            <!-- Brand -->
            <a
                href="index.php"
                class="font-display text-3xl md:text-4xl tracking-tight text-[#1b1c1a]"
            >
                कला'ctive
            </a>

            <!-- Right -->
            <div class="flex items-center gap-5">

                <a href="wishlist.php" aria-label="Wishlist" class="text-[#1b1c1a] hover:text-[#974724] transition-colors">
                    <span class="material-symbols-outlined">favorite</span>
                </a>

                <a href="cart.php" aria-label="Shopping cart" class="text-[#1b1c1a] hover:text-[#974724] transition-colors">
                    <span class="material-symbols-outlined">shopping_bag</span>
                </a>

                <a href="login.php" aria-label="Account" class="text-[#1b1c1a] hover:text-[#974724] transition-colors">
                    <span class="material-symbols-outlined">person</span>
                </a>

                <button
                    id="mobile-menu-button"
                    class="md:hidden text-[#1b1c1a]"
                    aria-label="Open menu"
                >
                    <span class="material-symbols-outlined">menu</span>
                </button>

            </div>
        </div>
    </nav>


    <main>

        <!-- =================================================
             HERO
             ================================================= -->

        <section class="story-hero">

            <img
                src="images/banners/story-hero.jpg"
                alt="Rajasthani inspired interior"
                class="absolute inset-0 w-full h-full object-cover story-hero-image"
                onerror="this.style.display='none';"
            >

            <div class="absolute inset-0 story-overlay"></div>

            <div class="relative z-10 min-h-screen flex items-center">

                <div class="max-w-[1440px] mx-auto w-full px-6 md:px-16">

                    <div class="max-w-3xl text-white">

                        <p
                            class="story-label text-xs md:text-sm uppercase mb-7 opacity-90"
                            data-reveal
                        >
                            KALACTIVE • A CURATION BY RANGREZ
                        </p>

                        <h1
                            class="font-display text-6xl md:text-8xl lg:text-[110px] leading-[0.9] tracking-tight mb-8"
                            data-reveal
                        >
                            Rooted in
                            <br>
                            <em class="font-normal">heritage.</em>
                        </h1>

                        <p
                            class="max-w-xl text-base md:text-lg leading-relaxed text-white/85"
                            data-reveal
                        >
                            A contemporary interpretation of the colours, craft,
                            architecture and stories that make Indian homes feel alive.
                        </p>

                        <div class="mt-10" data-reveal>
                            <a
                                href="#story"
                                class="inline-flex items-center gap-3 border border-white/70 px-7 py-4 uppercase text-xs tracking-[0.2em] hover:bg-white hover:text-[#1b1c1a] transition-all duration-300"
                            >
                                Discover our story
                                <span class="material-symbols-outlined text-base">
                                    arrow_downward
                                </span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- =================================================
             OPENING STATEMENT
             ================================================= -->

        <section
            id="story"
            class="py-28 md:py-40 px-6 md:px-16 bg-[#faf9f5]"
        >

            <div class="max-w-5xl mx-auto text-center">

                <p class="story-label text-xs uppercase text-[#974724] mb-10">
                    THE IDEA
                </p>

                <h2
                    class="story-quote text-4xl md:text-6xl lg:text-7xl"
                    data-reveal
                >
                    “A home should not simply
                    <br class="hidden md:block">
                    be beautiful.
                    <br>
                    It should feel
                    <em class="text-[#974724]">like yours.</em>”
                </h2>

                <div class="w-20 h-px bg-[#974724] mx-auto my-12 opacity-50"></div>

                <p
                    class="max-w-2xl mx-auto text-base md:text-lg text-[#6f6e68] leading-8"
                    data-reveal
                >
                    KALACTIVE was born from a simple belief:
                    the objects around us can carry memory, culture and personality.
                    We curate pieces that allow those stories to live in modern homes.
                </p>

            </div>

        </section>


        <!-- =================================================
             STORY SECTION 01
             ================================================= -->

        <section class="py-20 md:py-32 px-6 md:px-16 bg-[#f5f2ea]">

            <div class="max-w-[1280px] mx-auto grid lg:grid-cols-2 gap-14 lg:gap-24 items-center">

                <div
                    class="story-image-wrap relative overflow-hidden story-frame"
                    data-reveal
                >

                    <div class="aspect-[4/5] overflow-hidden bg-[#dfd3c0]">

                        <img
                            src="https://i.pinimg.com/1200x/65/14/f6/6514f67894a8a6aad46d4fe5270065cc.jpg"
                            class="story-image w-full h-full object-cover"
                            onerror="this.src='images/banners/story-hero.jpg';"
                        >

                    </div>

                    <div class="absolute top-5 left-5 story-pill bg-[#faf9f5]/95 px-4 py-2 text-[10px] uppercase">
                        CHAPTER I
                    </div>

                </div>


                <div>

                    <p class="story-number text-7xl mb-2">
                        01
                    </p>

                    <p class="story-label text-xs uppercase text-[#974724] mb-6">
                        CRAFT & MEMORY
                    </p>

                    <h2 class="font-display text-5xl md:text-6xl leading-tight mb-8">
                        Where the
                        <em>old</em>
                        meets the now.
                    </h2>

                    <div class="story-rule w-20 mb-8"></div>

                    <p class="text-[#6f6e68] text-base md:text-lg leading-8 mb-6">
                        Rajasthan has always understood the language of detail.
                        A carved doorway. A brass vessel. A handwoven textile.
                        A colour that catches the evening light.
                    </p>

                    <p class="text-[#6f6e68] text-base md:text-lg leading-8">
                        We take inspiration from that visual vocabulary and reinterpret
                        it for the way people live today — without losing the soul of
                        where it came from.
                    </p>

                </div>

            </div>

        </section>


        <!-- =================================================
             HERITAGE QUOTE
             ================================================= -->

        <section class="py-28 md:py-36 px-6 md:px-16 bg-[#1b1c1a] text-[#faf9f5]">

            <div class="max-w-5xl mx-auto text-center">

                <p class="story-label text-xs uppercase text-[#d5ad78] mb-10">
                    RANGREZ
                </p>

                <h2
                    class="story-quote text-4xl md:text-6xl lg:text-7xl"
                    data-reveal
                >
                    Colour is not decoration.
                    <br>
                    <span class="text-[#d5ad78]">It is memory.</span>
                </h2>

                <p
                    class="max-w-2xl mx-auto mt-10 text-[#faf9f5]/65 leading-8"
                    data-reveal
                >
                    “Rangrez” speaks to the spirit of the colour-maker —
                    the one who gives life to cloth, walls, objects and spaces.
                    That spirit sits at the heart of KALACTIVE.
                </p>

            </div>

        </section>


        <!-- =================================================
             STORY SECTION 02
             ================================================= -->

        <section class="py-20 md:py-32 px-6 md:px-16 bg-[#faf9f5]">

            <div class="max-w-[1280px] mx-auto grid lg:grid-cols-2 gap-14 lg:gap-24 items-center">

                <div class="lg:order-2">

                    <div class="story-image-wrap relative overflow-hidden story-frame">

                        <div class="aspect-[4/5] overflow-hidden bg-[#ddcfbb]">

                            <img
                                src="https://i.pinimg.com/736x/11/95/e1/1195e18c92b3103ca49277fdae350c7f.jpg"
                                alt="Contemporary Indian home interior"
                                class="story-image w-full h-full object-cover"
                                onerror="this.src='images/banners/story-hero.jpg';"
                            >

                        </div>

                        <div class="absolute top-5 left-5 story-pill bg-[#faf9f5]/95 px-4 py-2 text-[10px] uppercase">
                            CHAPTER II
                        </div>

                    </div>

                </div>


                <div class="lg:order-1">

                    <p class="story-number text-7xl mb-2">
                        02
                    </p>

                    <p class="story-label text-xs uppercase text-[#974724] mb-6">
                        FOR THE EVERYDAY
                    </p>

                    <h2 class="font-display text-5xl md:text-6xl leading-tight mb-8">
                        Heritage should
                        <em>live.</em>
                    </h2>

                    <div class="story-rule w-20 mb-8"></div>

                    <p class="text-[#6f6e68] text-base md:text-lg leading-8 mb-6">
                        KALACTIVE isn't about putting the past behind glass.
                        It is about bringing its beauty into the everyday.
                    </p>

                    <p class="text-[#6f6e68] text-base md:text-lg leading-8 mb-8">
                        A lamp beside your reading chair.
                        A ceramic vase on a dining table.
                        A mirror catching the last light of the day.
                        Small things can completely change how a room feels.
                    </p>

                    <a
                        href="rooms.php"
                        class="inline-flex items-center gap-3 text-xs uppercase tracking-[0.18em] text-[#974724] hover:gap-5 transition-all"
                    >
                        Explore the rooms
                        <span class="material-symbols-outlined text-base">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </div>

        </section>


        <!-- =================================================
             VALUES
             ================================================= -->

        <section class="py-24 md:py-32 px-6 md:px-16 bg-[#f5f2ea]">

            <div class="max-w-[1280px] mx-auto">

                <div class="text-center mb-20">

                    <p class="story-label text-xs uppercase text-[#974724] mb-5">
                        WHAT WE BELIEVE
                    </p>

                    <h2 class="font-display text-5xl md:text-6xl">
                        Three things we keep close.
                    </h2>

                </div>


                <div class="grid md:grid-cols-3 border-t border-[#c9c7bd]">

                    <article
                        class="py-12 md:px-10 md:border-r border-[#c9c7bd]"
                        data-reveal
                    >

                        <span class="story-number text-5xl">
                            01
                        </span>

                        <h3 class="font-display text-3xl mt-7 mb-5">
                            Craft
                        </h3>

                        <p class="text-[#6f6e68] leading-7">
                            We value objects that show the hand behind them.
                            Texture, imperfection and materiality are part of their charm.
                        </p>

                    </article>


                    <article
                        class="py-12 md:px-10 md:border-r border-[#c9c7bd]"
                        data-reveal
                    >

                        <span class="story-number text-5xl">
                            02
                        </span>

                        <h3 class="font-display text-3xl mt-7 mb-5">
                            Character
                        </h3>

                        <p class="text-[#6f6e68] leading-7">
                            We don't believe every home needs to look the same.
                            A memorable room has a point of view.
                        </p>

                    </article>


                    <article
                        class="py-12 md:px-10"
                        data-reveal
                    >

                        <span class="story-number text-5xl">
                            03
                        </span>

                        <h3 class="font-display text-3xl mt-7 mb-5">
                            Timelessness
                        </h3>

                        <p class="text-[#6f6e68] leading-7">
                            Trends come and go.
                            Beautiful objects should have enough soul to stay.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        <!-- =================================================
             FINAL STATEMENT
             ================================================= -->

        <section class="py-32 md:py-44 px-6 md:px-16 bg-[#faf9f5] text-center">

            <div class="max-w-5xl mx-auto">

                <p class="story-label text-xs uppercase text-[#974724] mb-10">
                    THE KALACTIVE WAY
                </p>

                <h2
                    class="font-display text-5xl md:text-7xl lg:text-8xl leading-[0.95]"
                    data-reveal
                >
                    Not old.
                    <br>
                    Not ordinary.
                    <br>
                    <em class="text-[#974724]">Just timeless.</em>
                </h2>

                <p
                    class="max-w-2xl mx-auto mt-10 text-[#6f6e68] text-base md:text-lg leading-8"
                    data-reveal
                >
                    Discover pieces that bring a little more history,
                    colour and character into the spaces you call home.
                </p>

            </div>

        </section>


        <!-- =================================================
             CTA
             ================================================= -->

        <section class="story-footer-cta text-[#faf9f5]">

            <div class="max-w-[1280px] mx-auto px-6 md:px-16 py-20 md:py-28">

                <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-10">

                    <div>

                        <p class="story-label text-xs uppercase text-[#f5d3b6] mb-6">
                            BEGIN YOUR COLLECTION
                        </p>

                        <h2 class="font-display text-5xl md:text-7xl leading-none">
                            Find something
                            <br>
                            worth keeping.
                        </h2>

                    </div>

                    <a
                        href="products.php"
                        class="inline-flex items-center gap-4 border border-white/60 px-8 py-4 uppercase text-xs tracking-[0.2em] hover:bg-white hover:text-[#974724] transition-all duration-300"
                    >
                        Shop the collection
                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </div>

        </section>

    </main>


    <!-- =====================================================
         FOOTER
         ===================================================== -->

    <footer class="bg-[#1b1c1a] text-[#faf9f5]">

        <div class="max-w-[1440px] mx-auto px-6 md:px-16 py-20">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

                <div class="md:col-span-1">

                    <a
                        href="index.php"
                        class="font-display text-4xl"
                    >
                        कला'ctive
                    </a>

                    <p class="story-label text-[10px] uppercase text-white/50 mt-5">
                        CURATED BY RANGREZ
                    </p>

                </div>


                <div>

                    <p class="story-label text-[10px] uppercase text-white/40 mb-5">
                        EXPLORE
                    </p>

                    <div class="space-y-3 text-sm text-white/70">

                        <a href="products.php" class="block hover:text-white transition">
                            Shop
                        </a>

                        <a href="rooms.php" class="block hover:text-white transition">
                            Rooms
                        </a>

                        <a href="story.php" class="block hover:text-white transition">
                            Our Story
                        </a>

                    </div>

                </div>


                <div>

                    <p class="story-label text-[10px] uppercase text-white/40 mb-5">
                        HELP
                    </p>

                    <div class="space-y-3 text-sm text-white/70">

                        <a href="help.php" class="block hover:text-white transition">
                            Contact
                        </a>

                        <a href="help.php" class="block hover:text-white transition">
                            Shipping
                        </a>

                        <a href="help.php" class="block hover:text-white transition">
                            Returns
                        </a>

                    </div>

                </div>


                <div>

                    <p class="story-label text-[10px] uppercase text-white/40 mb-5">
                        STAY IN THE KNOW
                    </p>

                    <form action="#" method="post" class="flex border-b border-white/30">

                        <input
                            type="email"
                            name="email"
                            placeholder="Your email"
                            required
                            class="w-full bg-transparent border-0 px-0 py-3 text-sm text-white placeholder:text-white/40 focus:ring-0 focus:border-0"
                        >

                        <button
                            type="submit"
                            class="text-[#d5ad78]"
                            aria-label="Subscribe"
                        >
                            <span class="material-symbols-outlined">
                                arrow_forward
                            </span>
                        </button>

                    </form>

                </div>

            </div>


            <div class="story-rule mt-16 opacity-20"></div>

            <div class="flex flex-col md:flex-row justify-between gap-4 pt-8 text-xs text-white/40">

                <p>
                    © <?php echo date("Y"); ?> KALACTIVE. ALL RIGHTS RESERVED.
                </p>

                <p>
                    A CURATION BY RANGREZ.
                </p>

            </div>

        </div>

    </footer>


    <!-- Existing shared JavaScript -->
    <script src="js/script.js"></script>

    <!-- Story-page-only behavior -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const reveals = document.querySelectorAll("[data-reveal]");

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = "1";
                            entry.target.style.transform = "translateY(0)";
                            observer.unobserve(entry.target);
                        }
                    });
                },
                {
                    threshold: 0.12
                }
            );

            reveals.forEach((element, index) => {
                element.style.opacity = "0";
                element.style.transform = "translateY(24px)";
                element.style.transition =
                    `opacity 800ms cubic-bezier(0.16, 1, 0.3, 1) ${Math.min(index * 70, 350)}ms,
                     transform 800ms cubic-bezier(0.16, 1, 0.3, 1) ${Math.min(index * 70, 350)}ms`;

                observer.observe(element);
            });


            /* Navbar transition */
            const nav = document.getElementById("main-nav");

            window.addEventListener("scroll", function () {
                if (window.scrollY > 40) {
                    nav.classList.add("bg-[#faf9f5]/95");
                    nav.classList.add("backdrop-blur-sm");
                    nav.classList.add("border-[#c9c7bd]");
                } else {
                    nav.classList.remove("bg-[#faf9f5]/95");
                    nav.classList.remove("backdrop-blur-sm");
                    nav.classList.remove("border-[#c9c7bd]");
                }
            });

        });
    </script>

</body>
</html>
