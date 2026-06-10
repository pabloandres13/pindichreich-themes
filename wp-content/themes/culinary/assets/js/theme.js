/* Culinary theme JS */
(function () {
  'use strict';

  // ---- Header scroll shadow ----
  const header = document.querySelector('.culinary-header');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });
  }

  // ---- Mobile menu toggle ----
  const toggle = document.querySelector('.culinary-menu-toggle');
  const nav    = document.querySelector('.culinary-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      const open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
      toggle.querySelector('i[data-lucide]').setAttribute('data-lucide', open ? 'x' : 'menu');
      if (window.lucide) window.lucide.createIcons({ nameAttr: 'data-lucide' });
    });
  }

  // ---- Search toggle ----
  const searchToggle = document.querySelector('.culinary-search-toggle');
  const searchForm   = document.querySelector('.culinary-search-form');
  if (searchToggle && searchForm) {
    searchToggle.addEventListener('click', function () {
      searchForm.classList.toggle('is-open');
      if (searchForm.classList.contains('is-open')) {
        const inp = searchForm.querySelector('input');
        if (inp) inp.focus();
      }
    });
  }

  // ---- Entrance reveal (IntersectionObserver) ----
  const revealEls = document.querySelectorAll('.culinary-reveal');
  if ('IntersectionObserver' in window && revealEls.length) {
    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.remove('is-hidden');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08 });

    revealEls.forEach(function (el) {
      el.classList.add('is-hidden');
      io.observe(el);
    });
  }

  // ---- Lucide icons ----
  document.addEventListener('DOMContentLoaded', function () {
    if (window.lucide) window.lucide.createIcons();
  });

  // ---- Ingredient checklist (single recipe) ----
  document.querySelectorAll('.recipe-ingredients__item').forEach(function (item) {
    item.addEventListener('click', function () {
      item.classList.toggle('is-checked');
      const check = item.querySelector('.ingredient-check');
      if (check) check.classList.toggle('is-checked');
    });
  });

})();
