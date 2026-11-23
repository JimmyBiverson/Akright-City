import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

document.documentElement.classList.add('js');

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!reducedMotion) {
    document.documentElement.classList.add('has-anim');
} else {
    document.documentElement.classList.remove('has-anim');
}

document.addEventListener('DOMContentLoaded', () => {
    let lenis = null;

    gsap.registerPlugin(ScrollTrigger);

    if (!reducedMotion && window.matchMedia('(min-width: 768px)').matches) {
        lenis = new Lenis({
            duration: 1.15,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothWheel: true,
            syncTouch: false,
            wheelMultiplier: 1,
            touchMultiplier: 1.6,
            autoResize: true,
        });

        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => lenis.raf(time * 1000));
        gsap.ticker.lagSmoothing(0);
        window.__lenis = lenis;
    }

    const stopScroll = () => lenis?.stop();
    const startScroll = () => lenis?.start();

    const refreshScrollTriggers = () => ScrollTrigger.refresh();
    const header = document.querySelector('[data-site-header]');
    const mainNav = document.querySelector('[data-main-nav]');

    const updateHeader = () => {
        const scrolled = window.scrollY > 40;
        header?.classList.toggle('is-scrolled', scrolled);
        mainNav?.classList.toggle('is-scrolled', scrolled);
    };

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    const mobileNav = document.querySelector('[data-mobile-nav]');
    const mobileOverlay = document.querySelector('[data-mobile-overlay]');
    const mobileOpen = document.querySelector('[data-mobile-open]');
    const mobileClose = document.querySelector('[data-mobile-close]');
    const focusableSelector = 'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])';
    let lastFocusedElement = null;
    let lockedScrollY = 0;

    const closeMobileSubmenu = (toggle, submenu) => {
        submenu.classList.remove('open');
        submenu.style.maxHeight = '0px';
        toggle.setAttribute('aria-expanded', 'false');
    };

    const openMobileSubmenu = (toggle, submenu) => {
        submenu.classList.add('open');
        submenu.style.maxHeight = `${submenu.scrollHeight}px`;
        toggle.setAttribute('aria-expanded', 'true');
    };

    const syncOpenSubmenuHeights = () => {
        if (!mobileNav) {
            return;
        }

        mobileNav.querySelectorAll('[data-mobile-submenu-toggle]').forEach((toggle) => {
            const submenu = document.getElementById(toggle.getAttribute('aria-controls') ?? '');

            if (submenu?.classList.contains('open')) {
                submenu.style.maxHeight = `${submenu.scrollHeight}px`;
            }
        });
    };

    const closeMobileNav = () => {
        if (!mobileNav || !mobileOverlay || !mobileNav.classList.contains('is-open')) {
            return;
        }

        mobileNav.classList.remove('is-open');
        mobileOverlay.classList.remove('is-open');
        mobileNav.setAttribute('aria-hidden', 'true');
        mobileOpen?.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('nav-open');
        document.body.style.top = '';
        window.scrollTo(0, lockedScrollY);
        lenis?.scrollTo(lockedScrollY, { immediate: true, force: true });
        startScroll();
        refreshScrollTriggers();
        lastFocusedElement?.focus();
    };

    const openMobileNav = () => {
        if (!mobileNav || !mobileOverlay) {
            return;
        }

        lastFocusedElement = document.activeElement;
        lockedScrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
        stopScroll();
        document.body.style.top = `-${lockedScrollY}px`;
        document.body.classList.add('nav-open');
        mobileNav.classList.add('is-open');
        mobileOverlay.classList.add('is-open');
        mobileNav.setAttribute('aria-hidden', 'false');
        mobileOpen?.setAttribute('aria-expanded', 'true');
        syncOpenSubmenuHeights();
        mobileClose?.focus();
    };

    mobileOpen?.addEventListener('click', openMobileNav);
    mobileClose?.addEventListener('click', closeMobileNav);
    mobileOverlay?.addEventListener('click', closeMobileNav);

    mobileNav?.querySelectorAll('a[href]').forEach((link) => {
        link.addEventListener('click', closeMobileNav);
    });

    mobileNav?.querySelectorAll('[data-mobile-submenu-toggle]').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const submenu = document.getElementById(toggle.getAttribute('aria-controls') ?? '');
            if (!submenu) {
                return;
            }

            const shouldOpen = !submenu.classList.contains('open');

            mobileNav.querySelectorAll('[data-mobile-submenu-toggle]').forEach((otherToggle) => {
                if (otherToggle === toggle) {
                    return;
                }

                const otherSubmenu = document.getElementById(otherToggle.getAttribute('aria-controls') ?? '');

                if (otherSubmenu?.classList.contains('open')) {
                    closeMobileSubmenu(otherToggle, otherSubmenu);
                }
            });

            if (shouldOpen) {
                openMobileSubmenu(toggle, submenu);
            } else {
                closeMobileSubmenu(toggle, submenu);
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (!mobileNav?.classList.contains('is-open')) {
            return;
        }

        if (event.key === 'Escape') {
            closeMobileNav();
            return;
        }

        if (event.key !== 'Tab') {
            return;
        }

        const focusable = Array.from(mobileNav.querySelectorAll(focusableSelector));
        if (focusable.length === 0) {
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 991 && mobileNav?.classList.contains('is-open')) {
            closeMobileNav();
        }

        syncOpenSubmenuHeights();
    });

    const dropdowns = Array.from(document.querySelectorAll('.has-dropdown'));
    const hoverCapable = window.matchMedia('(hover: hover)').matches;

    const closeDropdowns = (except = null) => {
        dropdowns.forEach((dropdown) => {
            if (dropdown !== except) {
                dropdown.setAttribute('data-open', 'false');
                dropdown.querySelector('[data-dropdown-trigger]')?.setAttribute('aria-expanded', 'false');
            }
        });
    };

    dropdowns.forEach((dropdown) => {
        const trigger = dropdown.querySelector('[data-dropdown-trigger]');

        const setOpen = (open) => {
            if (open) {
                closeDropdowns(dropdown);
            }

            dropdown.setAttribute('data-open', String(open));
            trigger?.setAttribute('aria-expanded', String(open));
        };

        trigger?.addEventListener('click', (event) => {
            if (!hoverCapable) {
                event.preventDefault();
                setOpen(dropdown.getAttribute('data-open') !== 'true');
            }
        });

        if (hoverCapable) {
            dropdown.addEventListener('mouseenter', () => setOpen(true));
            dropdown.addEventListener('mouseleave', () => setOpen(false));
        }

        dropdown.addEventListener('focusin', () => setOpen(true));
        dropdown.addEventListener('focusout', (event) => {
            if (!dropdown.contains(event.relatedTarget)) {
                setOpen(false);
            }
        });

        dropdown.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
                trigger?.focus();
            }
        });
    });

    document.addEventListener('click', (event) => {
        if (!dropdowns.some((dropdown) => dropdown.contains(event.target))) {
            closeDropdowns();
        }
    });

    document.querySelectorAll('[data-tabs]').forEach((group) => {
        const buttons = Array.from(group.querySelectorAll('[data-tab-button]'));
        const panels = Array.from(group.querySelectorAll('[data-tab-panel]'));

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const target = button.dataset.tabButton;

                buttons.forEach((item) => {
                    const active = item === button;
                    item.classList.toggle('is-active', active);
                    item.setAttribute('aria-selected', String(active));
                });

                panels.forEach((panel) => {
                    panel.classList.toggle('hidden', panel.dataset.tabPanel !== target);
                });

                ScrollTrigger.refresh();
            });
        });
    });

    document.querySelectorAll('[data-load-embed]').forEach((button) => {
        button.addEventListener('click', () => {
            const target = button.closest('[data-embed-target]');

            if (!target) {
                return;
            }

            const frame = document.createElement('iframe');
            frame.src = button.dataset.embedSrc;
            frame.title = button.dataset.embedTitle ?? 'Embedded content';
            frame.className = 'absolute inset-0 h-full w-full border-0';
            frame.loading = 'lazy';
            frame.referrerPolicy = 'strict-origin-when-cross-origin';
            frame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
            frame.allowFullscreen = true;
            target.replaceChildren(frame);
        });
    });

    const hero = document.querySelector('[data-hero]');

    if (hero) {
        const slides = Array.from(hero.querySelectorAll('[data-hero-slide]'));
        const thumbs = Array.from(hero.querySelectorAll('[data-hero-thumb]'));
        const progress = hero.querySelector('[data-hero-progress]');
        const expand = hero.querySelector('[data-hero-expand]');
        const nextButton = hero.querySelector('[data-hero-next]');
        const previousButton = hero.querySelector('[data-hero-previous]');
        const duration = 6500;
        let currentSlide = 0;
        let slideTimer = null;
        let busy = false;

        const restartProgress = () => {
            if (!progress) {
                return;
            }

            progress.classList.remove('is-running');
            void progress.offsetWidth;
            progress.classList.add('is-running');
        };

        const schedule = () => {
            window.clearTimeout(slideTimer);

            if (!reducedMotion && slides.length > 1) {
                slideTimer = window.setTimeout(() => showSlide(currentSlide + 1), duration);
            }
        };

        const finish = (index) => {
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === index);
            });

            thumbs.forEach((thumb, thumbIndex) => {
                thumb.classList.toggle('is-active', thumbIndex === index);
                thumb.setAttribute('aria-selected', String(thumbIndex === index));
            });

            const copy = slides[index]?.querySelector('.hero-copy');

            if (copy && !reducedMotion) {
                gsap.fromTo(copy, { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.7, ease: 'power2.out', clearProps: 'all' });
            }

            currentSlide = index;
            restartProgress();
            schedule();
            busy = false;
        };

        const showSlide = (index, sourceRing = null) => {
            const target = (index + slides.length) % slides.length;

            if (busy || target === currentSlide || slides.length < 2) {
                return;
            }

            busy = true;
            window.clearTimeout(slideTimer);

            const sourceImage = slides[target]?.dataset.heroImage;

            if (reducedMotion || !expand || !gsap || !sourceRing) {
                if (expand && sourceImage) {
                    expand.src = sourceImage;
                }
                finish(target);
                return;
            }

            const heroBounds = hero.getBoundingClientRect();
            const ringBounds = sourceRing.getBoundingClientRect();

            expand.src = sourceImage;
            gsap.set(expand, {
                display: 'block',
                left: ringBounds.left - heroBounds.left,
                top: ringBounds.top - heroBounds.top,
                width: ringBounds.width,
                height: ringBounds.height,
                borderRadius: '50%',
                opacity: 0.85,
            });

            gsap.timeline({ onComplete: () => finish(target) })
                .to(expand, {
                    left: 0,
                    top: 0,
                    width: heroBounds.width,
                    height: heroBounds.height,
                    borderRadius: 0,
                    opacity: 1,
                    duration: 0.95,
                    ease: 'power3.inOut',
                })
                .set(expand, { display: 'none', opacity: 0 });
        };

        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                showSlide(index, thumb.querySelector('[data-hero-thumb-ring]'));
            });
        });

        nextButton?.addEventListener('click', () => showSlide(currentSlide + 1));
        previousButton?.addEventListener('click', () => showSlide(currentSlide - 1));

        hero.addEventListener('mouseenter', () => window.clearTimeout(slideTimer));
        hero.addEventListener('mouseleave', schedule);
        hero.addEventListener('focusin', () => window.clearTimeout(slideTimer));
        hero.addEventListener('focusout', schedule);

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                window.clearTimeout(slideTimer);
            } else {
                schedule();
            }
        });

        restartProgress();
        schedule();
    }

    const revealTargets = Array.from(document.querySelectorAll('[data-reveal], .reveal'));

    if (!reducedMotion && revealTargets.length > 0) {
        revealTargets.forEach((element) => {
            if (element.getBoundingClientRect().top <= window.innerHeight * 0.88) {
                return;
            }

            gsap.fromTo(element,
                { opacity: 0, y: 24 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1.05,
                    ease: 'power2.out',
                    clearProps: 'opacity,transform',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 86%',
                        once: true,
                    },
                });
        });
    }

    const zoomSections = Array.from(document.querySelectorAll('[data-cta-zoom]'));

    if (!reducedMotion && zoomSections.length > 0 && window.matchMedia('(min-width: 1024px)').matches) {
        zoomSections.forEach((zoom) => {
            const media = zoom.querySelector('[data-cta-zoom-media]');
            const ring = zoom.querySelector('[data-cta-zoom-ring]');
            const copy = zoom.querySelector('[data-cta-zoom-text]');

            if (!media || !ring || !copy) {
                return;
            }

            const isIntro = zoom.classList.contains('cta-zoom--intro');
            const introTextTargets = isIntro ? Array.from(copy.querySelectorAll('[data-intro-text]')) : [];
            const finalTextColors = introTextTargets.map((element) => window.getComputedStyle(element).color);
            const startColor = window.getComputedStyle(zoom).getPropertyValue('--intro-start-color').trim() || '#E6A352';

            const timeline = gsap.timeline({
                scrollTrigger: {
                    trigger: zoom,
                    start: 'top top',
                    end: zoom.dataset.ctaZoomEnd || '+=140%',
                    scrub: 1,
                    pin: true,
                    anticipatePin: 1,
                },
            });

            timeline
                .fromTo(media, { clipPath: 'circle(74px at 50% 50%)', scale: 1.14 }, { clipPath: 'circle(120% at 50% 50%)', scale: 1, duration: 2, ease: 'power2.in' }, 0)
                .fromTo(ring, { scale: 1, autoAlpha: 0.9 }, { scale: 340, autoAlpha: 0, duration: 2, ease: 'power2.in' }, 0)
                .fromTo(copy, { autoAlpha: isIntro ? 0.85 : 0.25, scale: isIntro ? 0.995 : 0.98 }, { autoAlpha: 1, scale: 1, duration: 1.1, ease: 'power2.out' }, '-=1');

            if (introTextTargets.length > 0) {
                timeline.fromTo(introTextTargets,
                    { color: startColor },
                    {
                        color: (index) => finalTextColors[index],
                        duration: 1.1,
                        ease: 'power2.out',
                        clearProps: 'color',
                    },
                    '<');
            }
        });
    }

    document.querySelectorAll('[data-particles]').forEach((canvas) => {
        if (reducedMotion) {
            return;
        }

        const context = canvas.getContext('2d');

        if (!context) {
            return;
        }

        let width = 0;
        let height = 0;
        let particles = [];
        let frame = null;
        let visible = false;

        const resize = () => {
            const bounds = canvas.getBoundingClientRect();
            const ratio = Math.min(window.devicePixelRatio || 1, 2);

            width = bounds.width;
            height = bounds.height;
            canvas.width = Math.floor(width * ratio);
            canvas.height = Math.floor(height * ratio);
            context.setTransform(ratio, 0, 0, ratio, 0, 0);

            const count = Math.min(70, Math.max(18, Math.floor(width / 22)));
            particles = Array.from({ length: count }, () => ({
                x: Math.random() * width,
                y: Math.random() * height,
                radius: Math.random() * 1.8 + 0.6,
                speedX: (Math.random() - 0.5) * 0.22,
                speedY: (Math.random() - 0.5) * 0.22,
                alpha: Math.random() * 0.35 + 0.15,
            }));
        };

        const draw = () => {
            context.clearRect(0, 0, width, height);

            particles.forEach((particle) => {
                particle.x += particle.speedX;
                particle.y += particle.speedY;

                if (particle.x < 0) particle.x = width;
                if (particle.x > width) particle.x = 0;
                if (particle.y < 0) particle.y = height;
                if (particle.y > height) particle.y = 0;

                context.beginPath();
                context.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                context.fillStyle = `rgba(231, 211, 166, ${particle.alpha})`;
                context.fill();
            });

            frame = window.requestAnimationFrame(draw);
        };

        const stop = () => {
            if (frame !== null) {
                window.cancelAnimationFrame(frame);
                frame = null;
            }
        };

        const start = () => {
            if (visible && !document.hidden && frame === null) {
                draw();
            }
        };

        resize();

        if ('ResizeObserver' in window) {
            new ResizeObserver(resize).observe(canvas);
        } else {
            window.addEventListener('resize', resize);
        }

        if ('IntersectionObserver' in window) {
            new IntersectionObserver((entries) => {
                visible = entries[0]?.isIntersecting ?? false;

                if (visible) {
                    start();
                } else {
                    stop();
                }
            }, { threshold: 0 }).observe(canvas);
        } else {
            visible = true;
            start();
        }

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stop();
            } else {
                start();
            }
        });
    });

    const lightbox = document.querySelector('[data-lightbox]');
    const lightboxImage = document.querySelector('[data-lightbox-image]');
    const lightboxClose = document.querySelector('[data-lightbox-close]');

    const closeLightbox = () => {
        if (!lightbox) {
            return;
        }

        lightbox.classList.add('hidden');
        document.body.style.overflow = '';
        startScroll();
        lastFocusedElement?.focus();
    };

    document.querySelectorAll('[data-gallery-image]').forEach((button) => {
        button.addEventListener('click', () => {
            if (!lightbox || !lightboxImage) {
                return;
            }

            lastFocusedElement = document.activeElement;
            lightboxImage.src = button.dataset.galleryImage;
            lightboxImage.alt = button.dataset.galleryAlt ?? button.getAttribute('aria-label') ?? '';
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            stopScroll();
            lightboxClose?.focus();
        });
    });

    lightboxClose?.addEventListener('click', closeLightbox);

    lightbox?.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });

    const headerOffset = () => (header?.offsetHeight ?? 0) + 8;

    document.querySelectorAll('a[href*="#"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const href = link.getAttribute('href') ?? '';
            const hashIndex = href.indexOf('#');

            if (hashIndex < 0) {
                return;
            }

            const hash = href.slice(hashIndex);

            if (hash.length < 2) {
                return;
            }

            const samePage = href.charAt(0) === '#' || href.slice(0, hashIndex) === window.location.pathname;

            if (!samePage) {
                return;
            }

            let target = null;

            try {
                target = document.querySelector(hash);
            } catch {
                return;
            }

            if (!target) {
                return;
            }

            event.preventDefault();

            if (lenis) {
                lenis.scrollTo(target, { offset: -headerOffset(), duration: 1.4 });
            } else {
                const top = target.getBoundingClientRect().top + window.pageYOffset - headerOffset();
                window.scrollTo({ top, behavior: reducedMotion ? 'auto' : 'smooth' });
            }
        });
    });

    if (!reducedMotion && document.querySelector('.vh-bgs')) {
        gsap.to('.vh-bgs', {
            yPercent: 6,
            ease: 'none',
            scrollTrigger: {
                trigger: '[data-hero]',
                start: 'top top',
                end: 'bottom top',
                scrub: 1,
            },
        });
    }

    const refresh = () => ScrollTrigger.refresh();

    Array.from(document.images).forEach((image) => {
        if (image.complete) {
            return;
        }

        image.addEventListener('load', refresh, { once: true });
        image.addEventListener('error', refresh, { once: true });
    });

    window.addEventListener('load', refresh);
    window.setTimeout(refresh, 1200);
});
