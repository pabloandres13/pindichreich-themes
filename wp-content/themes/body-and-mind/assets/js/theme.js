(function () {
  'use strict';

  /* ---- Sticky header ---- */
  const header = document.querySelector('.bm-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---- Mobile menu toggle ---- */
  const toggle = document.getElementById('bm-menu-toggle');
  const mobileNav = document.getElementById('bm-mobile-nav');
  if (toggle && mobileNav) {
    toggle.addEventListener('click', () => {
      const isOpen = mobileNav.classList.toggle('is-open');
      header?.classList.toggle('is-open', isOpen);
      toggle.setAttribute('aria-expanded', String(isOpen));
      toggle.querySelector('[data-icon="open"]')?.classList.toggle('hidden', isOpen);
      toggle.querySelector('[data-icon="close"]')?.classList.toggle('hidden', !isOpen);
    });

    // Close on resize above breakpoint
    const mq = window.matchMedia('(min-width: 861px)');
    mq.addEventListener('change', () => {
      if (mq.matches) {
        mobileNav.classList.remove('is-open');
        header?.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- Schedule day tabs ---- */
  const tabs = document.querySelectorAll('.bm-day-tab');
  tabs.forEach((tab) => {
    tab.addEventListener('click', () => {
      tabs.forEach((t) => t.classList.remove('is-active'));
      tab.classList.add('is-active');
      const day = tab.dataset.day;
      document.querySelectorAll('.bm-day-pane').forEach((pane) => {
        pane.hidden = pane.dataset.day !== day;
      });
    });
  });

  /* ---- Cookie banner ---- */
  const banner = document.getElementById('bm-cookie-banner');
  if (banner) {
    let consent = null;
    try { consent = JSON.parse(localStorage.getItem('bm-cookie-consent')); } catch (e) {}
    if (!consent) banner.removeAttribute('hidden');

    const acceptBtn = banner.querySelector('[data-action="accept"]');
    const rejectBtn = banner.querySelector('[data-action="reject"]');
    const saveBtn   = banner.querySelector('[data-action="save"]');
    const settingsToggle = banner.querySelector('[data-action="settings"]');
    const settingsPanel  = banner.querySelector('.bm-cookie__settings');
    const toggles = banner.querySelectorAll('.bm-cookie__toggle');

    const dismiss = (data) => {
      try { localStorage.setItem('bm-cookie-consent', JSON.stringify(data)); } catch (e) {}
      banner.setAttribute('hidden', '');
    };

    acceptBtn?.addEventListener('click', () => {
      dismiss({ necessary: true, statistics: true, marketing: true });
    });

    rejectBtn?.addEventListener('click', () => {
      dismiss({ necessary: true, statistics: false, marketing: false });
    });

    settingsToggle?.addEventListener('click', () => {
      settingsPanel?.classList.toggle('is-open');
    });

    toggles.forEach((t) => {
      if (!t.disabled) {
        t.addEventListener('click', () => {
          t.classList.toggle('is-on');
        });
      }
    });

    saveBtn?.addEventListener('click', () => {
      const data = { necessary: true };
      banner.querySelectorAll('.bm-cookie__toggle[data-category]').forEach((t) => {
        data[t.dataset.category] = t.classList.contains('is-on');
      });
      dismiss(data);
    });
  }

  // Reopen cookie settings from footer link
  document.querySelectorAll('[data-action="cookie-settings"]').forEach((el) => {
    el.addEventListener('click', (e) => {
      e.preventDefault();
      const b = document.getElementById('bm-cookie-banner');
      if (b) b.removeAttribute('hidden');
    });
  });

  /* ---- Entrance animations (intersection observer) ---- */
  if ('IntersectionObserver' in window) {
    const style = document.createElement('style');
    style.textContent = `
      .bm-reveal { opacity: 1; transform: none; }
      @media (prefers-reduced-motion: no-preference) {
        .bm-reveal {
          opacity: 0;
          transform: translateY(18px);
          transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.16,1,0.3,1);
        }
        .bm-reveal.is-visible {
          opacity: 1;
          transform: none;
        }
      }
    `;
    document.head.appendChild(style);

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.bm-reveal').forEach((el) => observer.observe(el));
  }

  /* ---- Contact form (no-JS-safe progressive enhancement) ---- */
  const contactForm = document.getElementById('bm-contact-form');
  if (contactForm) {
    const successMsg = document.getElementById('bm-contact-success');
    const consentCheck = document.getElementById('bm-consent');
    const submitBtn = contactForm.querySelector('[type="submit"]');

    const updateSubmit = () => {
      if (submitBtn && consentCheck) {
        submitBtn.disabled = !consentCheck.checked;
      }
    };
    consentCheck?.addEventListener('change', updateSubmit);
    updateSubmit();

    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      if (!consentCheck?.checked) return;
      contactForm.setAttribute('hidden', '');
      successMsg?.removeAttribute('hidden');
    });
  }
})();
