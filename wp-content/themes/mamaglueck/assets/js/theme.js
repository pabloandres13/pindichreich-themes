/* Mamaglück — theme interactions */
(function () {
  'use strict';

  // Lucide icons
  if (window.lucide) lucide.createIcons();

  // Header shadow on scroll
  var header = document.getElementById('siteHeader');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // Mobile hamburger menu
  var nav    = document.getElementById('nav');
  var toggle = document.getElementById('navToggle');
  if (nav && toggle) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
      toggle.setAttribute('aria-label', open ? 'Menü schließen' : 'Menü öffnen');
    });
    nav.querySelectorAll('.nav__links a, .nav__cta a').forEach(function (a) {
      a.addEventListener('click', function () { nav.classList.remove('is-open'); });
    });
  }

  // Entrance animation — only for above-the-fold elements
  var h = window.innerHeight || document.documentElement.clientHeight;
  document.querySelectorAll('.reveal').forEach(function (el) {
    if (el.getBoundingClientRect().top < h * 0.9) {
      el.classList.add('intro-anim');
    }
  });

  // Cookie banner
  var cookie = document.getElementById('cookie');
  if (cookie) {
    var showCookie = function () { cookie.classList.add('is-visible'); };
    var hideCookie = function () { cookie.classList.remove('is-visible'); };
    if (!localStorage.getItem('mg-cookie-ok')) {
      setTimeout(showCookie, 900);
    }
    var acceptBtn = document.getElementById('cookieAccept');
    if (acceptBtn) {
      acceptBtn.addEventListener('click', function () {
        localStorage.setItem('mg-cookie-ok', '1');
        hideCookie();
      });
    }
    var reopenLinks = [
      document.getElementById('cookieSettings'),
      document.getElementById('cookieSettingsBtn'),
    ];
    reopenLinks.forEach(function (el) {
      if (el) el.addEventListener('click', function (e) { e.preventDefault(); showCookie(); });
    });
  }
})();
