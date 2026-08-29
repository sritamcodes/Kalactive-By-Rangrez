<!-- Footer -->
<footer class="w-full py-section-gap px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container border-t bg-surface-container-high full-width bottom-0 mt-20">
    <div class="md:col-span-1 flex flex-col items-start">
        <a class="font-display-lg text-display-lg text-primary mb-8" href="index.php">KALATIVE</a>
        <p class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">CURATED BY RANGREZ.</p>
    </div>
    <div class="md:col-span-3 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="flex flex-col space-y-4">
            <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]" href="products.php">SHOP</a>
            <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]" href="products.php?category=royal-edit">COLLECTIONS</a>
            <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]" href="index.php#our-story">OUR STORY</a>
        </div>
        <div class="flex flex-col space-y-4">
            <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]" href="cart.php">BAG</a>
            <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4 transition-transform active:scale-[0.99]" href="login.php">ACCOUNT</a>
        </div>
        <div class="col-span-2 md:col-span-2">
            <p class="font-label-sm text-label-sm uppercase tracking-widest text-primary mb-4">JOIN THE NARRATIVE</p>
            <form class="flex items-end max-w-sm" onsubmit="event.preventDefault(); alert('Thank you for joining our newsletter!');">
                <div class="relative w-full">
                    <label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant absolute -top-5 left-0" for="email">EMAIL ADDRESS</label>
                    <input class="w-full bg-transparent border-0 border-b border-outline-variant focus:border-secondary focus:ring-0 px-0 py-2 font-body-md text-on-background placeholder-on-surface-variant/50 transition-colors" id="email" placeholder="Enter your email" type="email" required>
                </div>
                <button class="ml-4 text-secondary hover:text-primary transition-colors" type="submit">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </form>
        </div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Arrival Animations
        setTimeout(() => {
            document.querySelectorAll('.reveal-seq-1').forEach(el => el.classList.add('revealed'));
            document.querySelectorAll('.reveal-seq-2').forEach(el => el.classList.add('revealed'));
            document.querySelectorAll('.reveal-seq-3').forEach(el => el.classList.add('revealed'));
            document.querySelectorAll('.reveal-seq-4').forEach(el => el.classList.add('revealed'));
        }, 200);

        // Parallax Effect
        const heroBg = document.getElementById('hero-bg');
        const heroContent = document.getElementById('hero-content');
        
        document.addEventListener('mousemove', (e) => {
            if (window.scrollY > window.innerHeight) return;
            
            const x = (e.clientX / window.innerWidth - 0.5);
            const y = (e.clientY / window.innerHeight - 0.5);
            
            if (heroBg) {
                heroBg.style.transform = `translate(${x * 6}px, ${y * 6}px) scale(1.05)`;
            }
            if (heroContent) {
                 heroContent.style.transform = `translate(${x * -2}px, ${y * -2}px)`;
            }
        });

        // Navbar Transition on Scroll
        const nav = document.getElementById('main-nav');
        if (nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });
        }

        // Scroll Reveal Observer
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    });
</script>

<script src="js/script.js"></script>
</body>
</html>
