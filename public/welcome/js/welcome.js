document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('site-loader');
    if (loader) {
        window.setTimeout(() => loader.classList.add('is-hidden'), 250);
    }

    const navToggle = document.querySelector('.nav-toggle');
    const navigation = document.getElementById('main-nav');
    const closeNavigation = () => {
        if (!navToggle || !navigation) return;
        navigation.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
        navToggle.setAttribute('aria-label', 'Abrir menú');
        const icon = navToggle.querySelector('i');
        if (icon) icon.className = 'fa-solid fa-bars';
    };

    if (navToggle && navigation) {
        navToggle.addEventListener('click', () => {
            const willOpen = !navigation.classList.contains('is-open');
            navigation.classList.toggle('is-open', willOpen);
            navToggle.setAttribute('aria-expanded', String(willOpen));
            navToggle.setAttribute('aria-label', willOpen ? 'Cerrar menú' : 'Abrir menú');
            const icon = navToggle.querySelector('i');
            if (icon) icon.className = `fa-solid ${willOpen ? 'fa-xmark' : 'fa-bars'}`;
        });
        navigation.querySelectorAll('a').forEach(link => link.addEventListener('click', closeNavigation));
        window.addEventListener('resize', () => {
            if (window.innerWidth > 820) closeNavigation();
        });
    }

    const pageName = document.body.dataset.pageName || document.title || 'IFE Educabol';
    document.querySelectorAll('.js-whatsapp').forEach(link => {
        const context = link.dataset.context ? ` ${link.dataset.context}` : '';
        const message = `Hola, vengo de ${pageName} y quisiera más información.${context}`;
        link.href = `https://wa.me/59175553338?text=${encodeURIComponent(message)}`;
    });

    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', event => {
            const target = document.querySelector(link.getAttribute('href'));
            if (!target) return;
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    const reveals = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        reveals.forEach(element => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px' });
    reveals.forEach(element => observer.observe(element));
});
