(function () {
  'use strict';

  /* ---- Sticky header frost (appears after 24px scroll) ---- */
  const header = document.querySelector('.mc-header');
  if (header) {
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 24);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---- Mobile menu toggle ---- */
  const toggle = document.getElementById('mc-menu-toggle');
  const mobileNav = document.getElementById('mc-mobile-nav');
  if (toggle && mobileNav) {
    toggle.addEventListener('click', () => {
      const open = mobileNav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
      toggle.querySelector('[data-icon="open"]')?.classList.toggle('hidden', open);
      toggle.querySelector('[data-icon="close"]')?.classList.toggle('hidden', !open);
    });
    const mq = window.matchMedia('(min-width: 981px)');
    mq.addEventListener('change', () => {
      if (mq.matches) {
        mobileNav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- FAQ accordion ---- */
  document.querySelectorAll('.mc-faq__btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.mc-faq');
      const open = item.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', String(open));
    });
  });

  /* ---- Testimonial slider ---- */
  document.querySelectorAll('[data-mc-slider]').forEach((slider) => {
    const track = slider.querySelector('.mc-slider__track');
    const cards = Array.from(slider.querySelectorAll('.mc-quote'));
    const dotsWrap = slider.querySelector('.mc-testimonials__dots');
    const prev = slider.querySelector('[data-slider="prev"]');
    const next = slider.querySelector('[data-slider="next"]');
    if (!track || cards.length === 0) return;

    // How many cards are visible at once (3 desktop, 1 mobile).
    const perView = () => (window.matchMedia('(max-width: 980px)').matches ? 1 : 3);
    const pages = () => Math.max(1, cards.length - perView() + 1);
    const controls = slider.querySelector('.mc-slider__controls');
    let index = 0;
    let dots = [];

    const buildDots = () => {
      if (!dotsWrap) return;
      dotsWrap.innerHTML = '';
      dots = [];
      const n = pages();
      for (let i = 0; i < n; i++) {
        const d = document.createElement('button');
        d.className = 'mc-testimonials__dot';
        d.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        d.addEventListener('click', () => go(i));
        dotsWrap.appendChild(d);
        dots.push(d);
      }
    };

    const render = () => {
      const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || '0');
      const step = cards[0].getBoundingClientRect().width + gap;
      track.style.transform = 'translateX(' + (-index * step) + 'px)';
      dots.forEach((d, i) => d.classList.toggle('is-active', i === index));
      // Hide controls entirely when everything fits on one page.
      if (controls) controls.style.visibility = pages() > 1 ? 'visible' : 'hidden';
    };
    const go = (i) => { index = Math.max(0, Math.min(i, pages() - 1)); render(); };

    prev?.addEventListener('click', () => go(index - 1));
    next?.addEventListener('click', () => go(index + 1));
    window.addEventListener('resize', () => { buildDots(); go(index); }, { passive: true });
    buildDots();
    render();
  });

  /* ---- Lead-magnet / contact form success state (progressive enhancement) ---- */
  document.querySelectorAll('[data-mc-optin-form]').forEach((form) => {
    form.addEventListener('submit', (e) => {
      // Only intercept when no real endpoint is wired (href="#").
      const action = form.getAttribute('action') || '#';
      if (action !== '#' && action !== '') return;
      e.preventDefault();
      const success = form.parentElement.querySelector('[data-mc-optin-success]');
      if (success) { form.setAttribute('hidden', ''); success.removeAttribute('hidden'); }
    });
  });

  /* ---- Cookie banner (opt-in) ---- */
  const banner = document.getElementById('mc-cookie-banner');
  if (banner) {
    let consent = null;
    try { consent = JSON.parse(localStorage.getItem('mc-cookie-consent')); } catch (e) {}
    if (!consent) banner.removeAttribute('hidden');

    const dismiss = (data) => {
      try { localStorage.setItem('mc-cookie-consent', JSON.stringify(data)); } catch (e) {}
      banner.setAttribute('hidden', '');
    };
    banner.querySelector('[data-action="accept"]')?.addEventListener('click', () =>
      dismiss({ necessary: true, statistics: true, marketing: true }));
    banner.querySelector('[data-action="reject"]')?.addEventListener('click', () =>
      dismiss({ necessary: true, statistics: false, marketing: false }));

    const panel = banner.querySelector('.mc-cookie__settings');
    const save = banner.querySelector('[data-action="save"]');
    banner.querySelector('[data-action="settings"]')?.addEventListener('click', () => {
      const open = panel?.classList.toggle('is-open');
      if (save) save.style.display = open ? '' : 'none';
    });
    banner.querySelectorAll('.mc-cookie__toggle').forEach((t) => {
      if (!t.disabled) t.addEventListener('click', () => t.classList.toggle('is-on'));
    });
    save?.addEventListener('click', () => {
      const data = { necessary: true };
      banner.querySelectorAll('.mc-cookie__toggle[data-category]').forEach((t) => {
        data[t.dataset.category] = t.classList.contains('is-on');
      });
      dismiss(data);
    });
  }
  document.querySelectorAll('[data-action="cookie-settings"]').forEach((el) => {
    el.addEventListener('click', (e) => {
      e.preventDefault();
      document.getElementById('mc-cookie-banner')?.removeAttribute('hidden');
    });
  });

  /* ---- Reveal on scroll (enhances already-visible content) ---- */
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.mc-reveal').forEach((el) => observer.observe(el));
  } else {
    document.querySelectorAll('.mc-reveal').forEach((el) => el.classList.add('is-visible'));
  }
})();
