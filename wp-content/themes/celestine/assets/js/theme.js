(function () {
  'use strict';

  /* ---- Sticky header shadow on scroll ---- */
  var header = document.querySelector('.cel-header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---- Mobile menu toggle ---- */
  var toggle = document.getElementById('cel-menu-toggle');
  var mobileNav = document.getElementById('cel-mobile-nav');
  if (toggle && mobileNav) {
    toggle.addEventListener('click', function () {
      var isOpen = mobileNav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(isOpen));
      var open = toggle.querySelector('[data-icon="open"]');
      var close = toggle.querySelector('[data-icon="close"]');
      if (open) open.classList.toggle('hidden', isOpen);
      if (close) close.classList.toggle('hidden', !isOpen);
    });
    var mq = window.matchMedia('(min-width: 901px)');
    mq.addEventListener('change', function () {
      if (mq.matches) {
        mobileNav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- Reveal-on-scroll (enhances already-visible content) ---- */
  var reveals = document.querySelectorAll('.cel-reveal');
  if (reveals.length && 'IntersectionObserver' in window &&
      !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-visible'); });
  }

  /* ---- Cookie banner (consent, localStorage) ---- */
  var banner = document.getElementById('cel-cookie-banner');
  if (banner) {
    var KEY = 'celestine_consent';
    var stored = null;
    try { stored = localStorage.getItem(KEY); } catch (e) {}
    if (!stored) {
      banner.hidden = false;
    }
    banner.addEventListener('click', function (e) {
      var action = e.target.getAttribute('data-action');
      if (!action) return;
      if (action === 'accept' || action === 'reject') {
        try { localStorage.setItem(KEY, action); } catch (e) {}
        banner.hidden = true;
      }
    });
  }
})();
