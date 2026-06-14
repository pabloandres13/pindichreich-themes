(function () {
  'use strict';

  /* ---- Sticky header shadow on scroll ---- */
  var header = document.querySelector('.bl-header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---- Mobile menu toggle ---- */
  var toggle = document.getElementById('bl-menu-toggle');
  var mobileNav = document.getElementById('bl-mobile-nav');
  if (toggle && mobileNav) {
    toggle.addEventListener('click', function () {
      var isOpen = mobileNav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(isOpen));
      var open = toggle.querySelector('[data-icon="open"]');
      var close = toggle.querySelector('[data-icon="close"]');
      if (open) open.classList.toggle('hidden', isOpen);
      if (close) close.classList.toggle('hidden', !isOpen);
    });

    var mq = window.matchMedia('(min-width: 861px)');
    mq.addEventListener('change', function () {
      if (mq.matches) {
        mobileNav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- Cookie banner (DSGVO opt-in) ---- */
  var banner = document.getElementById('bl-cookie-banner');
  if (banner) {
    var consent = null;
    try { consent = JSON.parse(localStorage.getItem('bl-cookie-consent')); } catch (e) {}
    if (!consent) banner.removeAttribute('hidden');

    var acceptBtn = banner.querySelector('[data-action="accept"]');
    var rejectBtn = banner.querySelector('[data-action="reject"]');
    var saveBtn = banner.querySelector('[data-action="save"]');
    var settingsToggle = banner.querySelector('[data-action="settings"]');
    var settingsPanel = banner.querySelector('.bl-cookie__settings');
    var toggles = banner.querySelectorAll('.bl-cookie__toggle');

    var dismiss = function (data) {
      try { localStorage.setItem('bl-cookie-consent', JSON.stringify(data)); } catch (e) {}
      banner.setAttribute('hidden', '');
    };

    if (acceptBtn) acceptBtn.addEventListener('click', function () {
      dismiss({ necessary: true, statistics: true, marketing: true });
    });
    if (rejectBtn) rejectBtn.addEventListener('click', function () {
      dismiss({ necessary: true, statistics: false, marketing: false });
    });
    if (settingsToggle && settingsPanel && saveBtn) {
      settingsToggle.addEventListener('click', function () {
        var open = settingsPanel.classList.toggle('is-open');
        saveBtn.style.display = open ? '' : 'none';
      });
    }
    toggles.forEach(function (t) {
      if (!t.disabled) {
        t.addEventListener('click', function () { t.classList.toggle('is-on'); });
      }
    });
    if (saveBtn) saveBtn.addEventListener('click', function () {
      var data = { necessary: true };
      banner.querySelectorAll('.bl-cookie__toggle[data-category]').forEach(function (t) {
        data[t.dataset.category] = t.classList.contains('is-on');
      });
      dismiss(data);
    });
  }

  // Reopen cookie settings from footer link
  document.querySelectorAll('[data-action="cookie-settings"]').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      var b = document.getElementById('bl-cookie-banner');
      if (b) b.removeAttribute('hidden');
    });
  });

  /* ---- Entrance animations ---- */
  if ('IntersectionObserver' in window) {
    var style = document.createElement('style');
    style.textContent =
      '@media (prefers-reduced-motion: no-preference){' +
      '.bl-reveal{opacity:0;transform:translateY(18px);transition:opacity .5s ease,transform .5s cubic-bezier(0.16,1,0.3,1);}' +
      '.bl-reveal.is-visible{opacity:1;transform:none;}}';
    document.head.appendChild(style);

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.bl-reveal').forEach(function (el) { observer.observe(el); });
  }
})();
