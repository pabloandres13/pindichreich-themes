/* Aurum Arcana — Theme JS */

(function () {
  'use strict';

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* --- Header scroll behavior -------------------------------- */
  const header = document.querySelector('.aa-hdr');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('aa-hdr--stuck', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* --- Mobile menu ------------------------------------------- */
  const mobileToggle = document.querySelector('.aa-hdr__mobile-toggle');
  const mobileNav    = document.querySelector('.aa-mobile-nav');
  const mobileClose  = document.querySelector('.aa-mobile-nav__close');

  if (mobileToggle && mobileNav) {
    const openMenu = () => {
      mobileNav.classList.add('is-open');
      document.body.style.overflow = 'hidden';
      if (mobileClose) mobileClose.focus();
    };
    const closeMenu = () => {
      mobileNav.classList.remove('is-open');
      document.body.style.overflow = '';
      mobileToggle.focus();
    };

    mobileToggle.addEventListener('click', openMenu);
    if (mobileClose) mobileClose.addEventListener('click', closeMenu);

    mobileNav.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && mobileNav.classList.contains('is-open')) closeMenu();
    });
  }

  /* --- Search toggle ----------------------------------------- */
  const searchToggle = document.querySelector('.aa-hdr__search-toggle');
  const searchForm   = document.querySelector('.aa-search-overlay');

  if (searchToggle && searchForm) {
    searchToggle.addEventListener('click', () => {
      const isOpen = searchForm.classList.toggle('is-open');
      searchToggle.setAttribute('aria-expanded', isOpen);
      if (isOpen) {
        const input = searchForm.querySelector('input[type="search"]');
        if (input) input.focus();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && searchForm.classList.contains('is-open')) {
        searchForm.classList.remove('is-open');
        searchToggle.setAttribute('aria-expanded', 'false');
        searchToggle.focus();
      }
    });
  }

  /* --- Entrance reveal animations ---------------------------- */
  if (!prefersReducedMotion && typeof IntersectionObserver !== 'undefined') {
    const reveals = document.querySelectorAll('.aa-reveal');

    reveals.forEach((el) => el.classList.add('is-hidden'));

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.remove('is-hidden');
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    reveals.forEach((el) => observer.observe(el));
  }

  /* --- Category chip filtering (archive) --------------------- */
  const chips = document.querySelectorAll('.aa-chip-btn');
  const cards = document.querySelectorAll('.aa-blog-grid .aa-article');

  if (chips.length && cards.length) {
    chips.forEach((chip) => {
      chip.addEventListener('click', () => {
        chips.forEach((c) => {
          c.classList.remove('aa-tag--solid');
          c.classList.add('aa-tag');
        });
        chip.classList.add('aa-tag--solid');

        const cat = chip.dataset.category || 'all';
        cards.forEach((card) => {
          const cardCat = card.dataset.category || '';
          card.style.display = (cat === 'all' || cardCat === cat) ? '' : 'none';
        });
      });
    });
  }

  /* --- Phosphor icons init ----------------------------------- */
  if (window.PhosphorIcons && typeof window.PhosphorIcons.replaceAll === 'function') {
    window.PhosphorIcons.replaceAll();
  }
})();
