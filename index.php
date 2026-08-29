<!DOCTYPE html>
<html class="scroll-smooth" lang="en" style="">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>KALATIVE - A CURATION BY RANGREZ</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Playfair+Display:wght@500;600;700&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
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
        <link rel="stylesheet" href="css/style.css">

</head>


<body
    class="bg-background text-on-background font-body-md antialiased overflow-x-hidden selection:bg-secondary-container selection:text-on-secondary-container"
    data-mode="connect">


    <div class="texture-overlay"></div>
    <!-- TopNavBar -->
    <nav class="fixed top-0 left-0 w-full flex flex-col justify-center bg-transparent border-b border-transparent docked full-width z-50 reveal-seq-3 revealed"
        id="main-nav">
        <div
            class="max-w-[1440px] mx-auto w-full px-margin-mobile md:px-margin-desktop py-4 flex items-center justify-between">
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-secondary border-b border-secondary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300 opacity-80"
                    href="#">SHOP</a>
                <a class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300"
                    href="#">COLLECTIONS</a>
                <a class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300"
                    href="rooms.php">ROOMS</a>
                <a class="text-primary font-label-lg text-label-lg uppercase tracking-widest hover:text-secondary transition-colors duration-300"
                    href="#">OUR STORY</a>
            </div>
            <a class="font-headline-lg text-headline-lg tracking-tighter text-primary" href="#">कला'ctive</a>
            <div class="flex items-center space-x-6">
                <button class="text-primary hover:text-secondary transition-colors"><span
                        class="material-symbols-outlined">favorite</span></button>
                <button class="text-primary hover:text-secondary transition-colors"><span
                        class="material-symbols-outlined">shopping_bag</span></button>
                <button class="text-primary hover:text-secondary transition-colors"><span
                        class="material-symbols-outlined">person</span></button>
                <button class="md:hidden text-primary hover:text-secondary transition-colors"><span
                        class="material-symbols-outlined">menu</span></button>
            </div>
        </div>
    </nav>
    <main>
        <!-- 1. Hero Section -->
        <section
            class="relative w-full h-screen overflow-hidden flex items-center justify-center bg-primary-container"
            id="hero-section">

            <!-- Background Video -->
            <video
                id="hero-bg"
                class="absolute inset-0 w-full h-full object-cover"
                autoplay
                muted
                loop
                playsinline
                preload="auto"
                data-alt="A grand cinematic view of a Rajasthani palace courtyard, bathed in warm, soft sunlight.">
                <source src="videos/Hero-Video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Dark Overlay for Contrast -->
            <div class="absolute inset-0 bg-background/20 mix-blend-multiply"></div>

            <div
                class="relative z-10 flex flex-col items-center justify-center text-center px-4 w-full h-full pt-20"
                id="hero-content">

                <p class="font-label-lg text-label-lg uppercase tracking-widest text-primary mb-12">
                    <br>
                </p>

    
            </div>

            <div class="absolute bottom-8 left-margin-desktop hidden md:block z-10">
                <p class="font-label-sm text-label-sm uppercase tracking-widest text-primary/80">
                    CURATED INDIAN LIVING
                </p>
            </div>
        </section>
        <!-- 2. Brand Transition -->
        <section
            class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center flex flex-col items-center justify-center bg-background scroll-reveal visible">
            <h2
                class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary mb-8 max-w-3xl">
                A HOME IS A COLLECTION OF STORIES.</h2>
            <div class="w-24 h-[1px] bg-outline-variant"></div>
        </section>
        <!-- 3. Featured Collection -->
        <section
            class="py-section-gap px-margin-mobile md:px-margin-desktop bg-surface-container-low scroll-reveal visible"
            id="featured">
            <div class="max-w-container-max mx-auto">
                <div class="text-center mb-16">
                    <h2 class="font-headline-lg text-headline-lg text-on-background mb-4">THE ROYAL EDIT</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto">Objects inspired by
                        Indian craft, colour and quiet extravagance.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
                    <!-- Product 1 -->
                    <a class="group block border border-outline-variant p-4 bg-primary-container card-shadow transition-transform hover:-translate-y-1 duration-300 relative"
                        href="#">
                        <div class="aspect-[3/4] mb-6 overflow-hidden relative border border-outline-variant/50">
                            <img alt="Sculptural Vase"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                data-alt="A beautifully crafted sculptural ceramic vase"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPZabbBWyH2QZAvTlkjMGUvOjXtoJiFb-ApmF0IxLCCUyThcocDFVe3YM54TfBkaSE_M1Ct2oYN1VqMH6gwDEsClKoD3D-TywyeD6RSCYfNq8M6J6PjUsuQPE0u7BMkAPgOJm9oHh9-C0CmakWDbzhS9xGCIDoKDryb7n2y8VhMhPrMbNdfzeIkNDNtE9l4RtoWsJ6-bLxvC1ePyYxRLUwBeBewWV2q5Me76KOuDMR1tRYhHmVLts">
                            <span
                                class="absolute top-2 right-2 border border-outline bg-background/90 backdrop-blur px-2 py-1 font-label-sm text-label-sm uppercase text-primary">NEW</span>
                            <div
                                class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="bg-background/90 backdrop-blur px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest text-primary border border-outline transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">VIEW
                                    PIECE</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3
                                class="font-headline-md text-headline-md text-on-background mb-2 group-hover:text-secondary transition-colors">
                                Sculptural Vases</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">From ₹4,500</p>
                        </div>
                    </a>
                    <!-- Product 2 -->
                    <a class="group block border border-outline-variant p-4 bg-primary-container card-shadow transition-transform hover:-translate-y-1 duration-300 relative"
                        href="#">
                        <div class="aspect-[3/4] mb-6 overflow-hidden relative border border-outline-variant/50">
                            <img alt="Heritage Lamps"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                data-alt="An elegant brass table lamp"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1UCv6L4GGjoWS0S10rXAH04RIa7eU6P52s6Vg-NAETMB5imUDAPhYVYeQ7omCQ2O4gKVauD_MSPDUn9cQeJFRyqFDaUxxJSwRr9Av-CRIpMyS3rfn-nJsAhv46TJ_9N2CUu0O9KpD99A4PypOP44jrhsfi4Haeg9mMAMlhiOQHWxXVxbX-CiUVRQDFuLfjECCxfIvY44NfL3uioRRnVo6L9zEDS3BK5iDLyRCakQCzXn3lMIw5oo">
                            <div
                                class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="bg-background/90 backdrop-blur px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest text-primary border border-outline transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">VIEW
                                    PIECE</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3
                                class="font-headline-md text-headline-md text-on-background mb-2 group-hover:text-secondary transition-colors">
                                Heritage Lamps</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">From ₹12,000</p>
                        </div>
                    </a>
                    <!-- Product 3 -->
                    <a class="group block border border-outline-variant p-4 bg-primary-container card-shadow transition-transform hover:-translate-y-1 duration-300 relative"
                        href="#">
                        <div class="aspect-[3/4] mb-6 overflow-hidden relative border border-outline-variant/50">
                            <img alt="Arched Mirrors"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                data-alt="A stunning arched wall mirror"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD38KwQGly2Hs4r6YPKfJ8yqS6xpVh_2oW5H3N4m9KUoGVt1dTqf84xQaJJtevwBfcIr8ppe4HTD7d3ZhPZWhGZ1jBfqVkriVFnvQyxIbRBgMhtwydUKJhAtmoV7wyoO2QnZsNTGHQz892lp4pNA_GPEAeIT1dJGF4OAr4POod0josM8cpbNOCOvElVmlYTY75rkyvZyiTqmLafef1CddI88AQ5J_h6zI7wYNBHva8mPbwF5-AWCX0">
                            <div
                                class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="bg-background/90 backdrop-blur px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest text-primary border border-outline transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">VIEW
                                    PIECE</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3
                                class="font-headline-md text-headline-md text-on-background mb-2 group-hover:text-secondary transition-colors">
                                Arched Mirrors</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">From ₹8,900</p>
                        </div>
                    </a>
                    <!-- Product 4 -->
                    <a class="group block border border-outline-variant p-4 bg-primary-container card-shadow transition-transform hover:-translate-y-1 duration-300 relative"
                        href="#">
                        <div class="aspect-[3/4] mb-6 overflow-hidden relative border border-outline-variant/50">
                            <img alt="Ceramic Objects"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                data-alt="A curated arrangement of small, tactile ceramic objects"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWp4mSba07Vk46zA5Ixpen70m-URW4ZydPQrWVrC2TZmDodufBUDG81rv0SrR8pOEqzncLSExsFpU8vRhOCd7E_2Y73r3i7TLaJIX611ofOHY2dZP3-9UpWBT6CX4bCXKMK-yPJLVEoe4ezexvWAVIDlmq67kcKzVJzzYmF-qFcAzeifuZdtvDDw6lZb4aa6BAywqN8yKeZAGyxQ8D6QTxPMuBpYRicltC0sMMFdo97Fs_AU9omIs">
                            <span
                                class="absolute top-2 right-2 border border-outline bg-background/90 backdrop-blur px-2 py-1 font-label-sm text-label-sm uppercase text-primary">LIMITED</span>
                            <div
                                class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="bg-background/90 backdrop-blur px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest text-primary border border-outline transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">VIEW
                                    PIECE</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3
                                class="font-headline-md text-headline-md text-on-background mb-2 group-hover:text-secondary transition-colors">
                                Ceramic Objects</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">From ₹2,200</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- 4. Shop by Mood (Bento Grid Style) -->
        <section class="py-section-gap px-margin-mobile md:px-margin-desktop bg-background scroll-reveal visible">
            <div class="max-w-container-max mx-auto">
                <div
                    class="mb-12 md:mb-16 flex flex-col md:flex-row justify-between items-end border-b border-outline-variant pb-8">
                    <h2
                        class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-background mb-4 md:mb-0">
                        STYLE YOUR STORY</h2>
                    <a class="font-label-lg text-label-lg uppercase tracking-widest text-secondary hover:text-on-background transition-colors flex items-center group"
                        href="#">
                        EXPLORE MOODS <span
                            class="material-symbols-outlined ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 h-[800px]">
                    <!-- ROYAL - Large -->
                    <a class="group relative md:col-span-2 md:row-span-2 overflow-hidden border border-outline-variant bg-surface-container"
                        href="#">
                        <img alt="Royal Mood"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                            data-alt="A sumptuous, deeply textured interior showcasing a 'Royal' mood. Rich terracotta fabrics, dark carved wood furniture, and brass accents are arranged elegantly. The lighting is moody and dramatic, reminiscent of a modernized heritage palace setting."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuANGPdjenh-HchdLFRDtDePoBTHoGlNElBUu7Ra6fa89i8WuSPY3yqiokSKXgOdyWBI8DndgzX8dQbSfFQO3YsnEZZ_NzdN2HInAj2VPzLCp_ttpMucink-PqnHH0zpZmdlouvabBcqkN2NMSiSMR5v0FK-2tzhwolZXfAhuBVqc8UtwBF6tfYqrIgCa_7zVMYaTbCv9CHbiNEihPqt2Uay03mAc7bn_sJ0EzesbIymRgRr9vMuTlo">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-8 left-8">
                            <h3 class="font-headline-lg text-headline-lg text-on-background mb-2">ROYAL</h3>
                            <p class="font-body-md text-body-md text-on-background/80 flex items-center">Discover <span
                                    class="material-symbols-outlined ml-2 text-sm">trending_flat</span></p>
                        </div>
                    </a>
                    <!-- EARTHED - Medium -->
                    <a class="group relative overflow-hidden border border-outline-variant bg-surface-container"
                        href="#">
                        <img alt="Earthed Mood"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                            data-alt="A minimalist 'Earthed' mood setting featuring natural linen textiles, unglazed pottery, and muted sandstone colors. Soft, diffused daylight emphasizes the organic, tactile qualities of the materials, creating a serene, grounding atmosphere."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvPxqqiAOJba4inwMuFfbGcDBifewVm1LZxL4hWk84YEQoqKgWsMje7Xu6cL_x5kYTvum2Zgf1ArLMzUeNMDlENRSYXwS5vZp1zAyugiVxEmbxCWbMQ5C2nrljVi2HughPqI2P_69JRRfIqWI1EzpRSg_8hnirogKTsapkLaarkk06EHPuQi-iUGkr2hzFy_QTEUYsOphlq0cCQ0oOW3TxOr4a04U3bgCSB5Z6vWsW-WreS1tXosM">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-6 left-6">
                            <h3 class="font-headline-md text-headline-md text-on-background mb-1">EARTHED</h3>
                        </div>
                    </a>
                    <!-- PLAYFUL - Small Split -->
                    <div class="grid grid-cols-2 gap-4">
                        <a class="group relative overflow-hidden border border-outline-variant bg-surface-container"
                            href="#">
                            <img alt="Playful Mood"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                                data-alt="A 'Playful' interior vignette featuring unexpected pops of ochre and deep indigo against a clean parchment background. Quirky, modern sculptural accents sit alongside traditional craft items, captured in bright, lively lighting."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-VyD121SBKntKa0Kmmy363Hbhq6gG1bcYusVJMdf-FuZOo1t9Nl5qzQeFuW8c0iOnvzVMpOc_f-0-LsmpT_5mUqY0_tgLJd5QlYMP5xe2lFUJQv4ogFyws5OtSFMvRm5KHCaEB9WlodML9ChH54x-wH2Rgbl3tuFifRb3DCxdRixG43Q0lu-p_KOVTYkyD00A7KvxTM4xr4xibIZtnxDqvgmKl4N_n_Ne3q1bsoTUcb3SKuqFk4I">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent">
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <h3 class="font-headline-md text-headline-md text-on-background text-lg mb-1">PLAYFUL
                                </h3>
                            </div>
                        </a>
                        <a class="group relative overflow-hidden border border-outline-variant bg-surface-container"
                            href="#">
                            <img alt="Timeless Mood"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                                data-alt="A 'Timeless' corner displaying a classic, understated arrangement. A perfectly polished dark wood console table holds a simple, elegant vase with dried botanicals. The scene is quiet, refined, and enduring, with soft, directional light."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBcGKQiwDv52Qvv61A9no9kw0_hOHzy6sldasRRmJonJyHguMgDTRCvp6qrNrGxf9EooWaHNwuKcsQD55xpVc16-1H7J9cHcHk9qspkxQzawaD2c6yMGaMrkrO6lwXLpnbwGGLAvcznNjLX0oyaLWeULhuuDQTnndjDEr93WS8LATf6c-OF41PGACQRb3x2LEi4or_urc-FD8ZUEeAUuKo6lE_U-hk1ITRDX7GlZ3DE013zUcfKwGY">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent">
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <h3 class="font-headline-md text-headline-md text-on-background text-lg mb-1">TIMELESS
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- 6. Editorial Section -->
        <section
            class="py-section-gap bg-surface-container-low border-t border-b border-outline-variant my-section-gap scroll-reveal visible">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="w-full lg:w-1/2 relative">
                        <div class="aspect-[4/5] border border-outline-variant p-2 bg-primary-container card-shadow">
                            <img alt="Haveli Interior" class="w-full h-full object-cover"
                                data-alt="A breathtaking, expansive interior shot blending traditional haveli architecture with modern minimalist furniture. Tall, ornate arched windows allow shafts of soft sunlight to illuminate a clean, sophisticated living space. The mood is grand yet intimate."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDW2qKIIvI5aoJbAoSM6A9ifcnwHmfbnhkzWdFi88r_XLbtKKvE14ceEurnT3U1Kj8_FozyV-g22_F54A81_DpX5lZoTFKeLaEuQJQkDswE7oIbQvb_M7uO0BPA9kPsT3BngkQ1JMS_4OKMoL18UsITmRteJvM7OwC2d5flvJglS4hpkWMrrkElYkTM2qh4IqV7BJOzYity-WSfILVrl3aslP_7xaWjveljBV5ZF9bz7ztCutZE0dg">
                        </div>
                        <!-- Decorative element -->
                        <div
                            class="absolute -bottom-8 -right-8 w-48 h-48 border border-secondary opacity-20 hidden md:block">
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <h2
                            class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-background mb-8">
                            FROM THE HAVELI TO THE HOME.</h2>
                        <div class="w-16 h-[1px] bg-secondary mb-8"></div>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-6 leading-relaxed">
                            We believe that luxury isn't just about what you own, but the stories those objects tell.
                            Our curation bridges the gap between the majestic heritage of Indian craftsmanship and the
                            quiet restraint of contemporary living.
                        </p>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-12 leading-relaxed">
                            Every piece is a dialogue between the past and the present, designed to age beautifully in
                            your personal sanctuary.
                        </p>
                        <a class="btn-secondary" href="#">DISCOVER OUR STORY</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer
        class="w-full py-section-gap px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container border-t bg-surface-container-high full-width bottom-0">
        <div class="md:col-span-1 flex flex-col items-start">
            <a class="font-display-lg text-display-lg text-primary mb-8" href="#"><img src="images/logo.png"
                    alt=""></a>
            <p class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">CURATED BY RANGREZ.
            </p>
        </div>
        <div class="md:col-span-3 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="flex flex-col space-y-4">
                <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
                    href="#">SHOP</a>
                <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
                    href="#">COLLECTIONS</a>
                <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
                    href="#">OUR STORY</a>
            </div>
            <div class="flex flex-col space-y-4">
                <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
                    href="#">HELP</a>
                <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]"
                    href="#">CONTACT</a>
            </div>
            <div class="col-span-2 md:col-span-2">
                <p class="font-label-sm text-label-sm uppercase tracking-widest text-primary mb-4">JOIN THE NARRATIVE
                </p>
                <br>
                <form class="flex items-end max-w-sm">
                    <div class="relative w-full">
                        <label
                            class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant absolute -top-5 left-0"
                            for="email">EMAIL ADDRESS</label>
                        <input
                            class="w-full bg-transparent border-0 border-b border-outline-variant focus:border-secondary focus:ring-0 px-0 py-2 font-body-md text-on-background placeholder-on-surface-variant/50 transition-colors"
                            id="email" placeholder="Enter your email" type="email">
                    </div>
                    <button class="ml-4 text-secondary hover:text-primary transition-colors" type="submit">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </footer>
    




    <script src="js/script.js"></script>
</body>

</html>