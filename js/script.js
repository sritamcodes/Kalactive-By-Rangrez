document.addEventListener("DOMContentLoaded", () => {
            // Remove Loader
            setTimeout(() => {
                const loader = document.getElementById('loader-overlay');
                if (loader) {
                    loader.style.opacity = '0';
                    setTimeout(() => loader.remove(), 800);
                }
            }, 100);

            // Arrival Animations
            setTimeout(() => {
                document.querySelectorAll('.reveal-seq-1').forEach(el => el.classList.add('revealed'));
                document.querySelectorAll('.reveal-seq-2').forEach(el => el.classList.add('revealed'));
                document.querySelectorAll('.reveal-seq-3').forEach(el => el.classList.add('revealed'));
                document.querySelectorAll('.reveal-seq-4').forEach(el => el.classList.add('revealed'));
            }, 300);

            // Parallax Effect
            const heroBg = document.getElementById('hero-bg');
            const heroContent = document.getElementById('hero-content');

            // Ensure muted hero video starts when the browser allows autoplay.
            if (heroBg && window.matchMedia('(min-width: 768px)').matches) {
                heroBg.muted = true;
                heroBg.play().catch(() => {});
            }

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
            const mobileMenuButton = document.querySelector('[data-mobile-menu-button]');
            const mobileMenu = document.querySelector('[data-mobile-menu]');

            if (mobileMenuButton && mobileMenu) {
                const closeMobileMenu = () => {
                    mobileMenu.classList.remove('open');
                    document.body.classList.remove('mobile-menu-open');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                };

                mobileMenuButton.addEventListener('click', () => {
                    const isOpen = mobileMenu.classList.toggle('open');
                    mobileMenuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    document.body.classList.toggle('mobile-menu-open', isOpen);
                });

                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        closeMobileMenu();
                    });
                });

                document.addEventListener('click', (event) => {
                    if (!mobileMenu.classList.contains('open')) return;
                    if (mobileMenu.contains(event.target) || mobileMenuButton.contains(event.target)) return;
                    closeMobileMenu();
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeMobileMenu();
                    }
                });
            }

            window.addEventListener('scroll', () => {
                if (nav) {
                    if (window.scrollY > 50) {
                        nav.classList.add('scrolled');
                    } else {
                        nav.classList.remove('scrolled');
                    }
                }
            });

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
