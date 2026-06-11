(function () {
  'use strict';

  /* ---- Sticky header (translucent + blur on scroll) ---- */
  const header = document.querySelector('.au-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---- Mobile menu toggle ---- */
  const toggle = document.getElementById('au-menu-toggle');
  const mobileNav = document.getElementById('au-mobile-nav');
  if (toggle && mobileNav) {
    toggle.addEventListener('click', () => {
      const isOpen = mobileNav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(isOpen));
      toggle.querySelector('[data-icon="open"]')?.classList.toggle('hidden', isOpen);
      toggle.querySelector('[data-icon="close"]')?.classList.toggle('hidden', !isOpen);
    });

    const mq = window.matchMedia('(min-width: 861px)');
    mq.addEventListener('change', () => {
      if (mq.matches) {
        mobileNav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- Cookie banner (DSGVO opt-in) ---- */
  const banner = document.getElementById('au-cookie-banner');
  if (banner) {
    let consent = null;
    try { consent = JSON.parse(localStorage.getItem('au-cookie-consent')); } catch (e) {}
    if (!consent) banner.removeAttribute('hidden');

    const settingsPanel = banner.querySelector('.au-cookie__settings');
    const saveBtn = banner.querySelector('[data-action="save"]');

    const dismiss = (data) => {
      try { localStorage.setItem('au-cookie-consent', JSON.stringify(data)); } catch (e) {}
      banner.setAttribute('hidden', '');
    };

    banner.querySelector('[data-action="accept"]')?.addEventListener('click', () => {
      dismiss({ necessary: true, statistics: true, marketing: true });
    });

    banner.querySelector('[data-action="reject"]')?.addEventListener('click', () => {
      dismiss({ necessary: true, statistics: false, marketing: false });
    });

    banner.querySelector('[data-action="settings"]')?.addEventListener('click', () => {
      const open = settingsPanel?.classList.toggle('is-open');
      if (saveBtn) saveBtn.style.display = open ? '' : 'none';
    });

    saveBtn?.addEventListener('click', () => {
      const data = { necessary: true };
      banner.querySelectorAll('input[data-category]').forEach((t) => {
        data[t.dataset.category] = t.checked;
      });
      dismiss(data);
    });
  }

  // Reopen cookie settings from footer link
  document.querySelectorAll('[data-action="cookie-settings"]').forEach((el) => {
    el.addEventListener('click', (e) => {
      e.preventDefault();
      document.getElementById('au-cookie-banner')?.removeAttribute('hidden');
    });
  });

  /* ---- Entrance animations (gentle fade + rise) ----
     Hidden state is injected here, not in theme.css, so content
     stays visible without JS and in headless/reduced environments. */
  if ('IntersectionObserver' in window) {
    const style = document.createElement('style');
    style.textContent = `
      @media (prefers-reduced-motion: no-preference) {
        .au-reveal {
          opacity: 0;
          transform: translateY(8px);
          transition: opacity var(--dur-slow) var(--ease-out),
                      transform var(--dur-slow) var(--ease-out);
        }
        .au-reveal.is-visible {
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

    document.querySelectorAll('.au-reveal').forEach((el) => observer.observe(el));
  }

  /* ---- Contact form (consent gating + success state) ---- */
  const contactForm = document.getElementById('au-contact-form');
  if (contactForm) {
    const successMsg = document.getElementById('au-contact-success');
    const consentCheck = document.getElementById('au-consent');
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
