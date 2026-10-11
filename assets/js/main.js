(function () {
  'use strict';

  // Accessible mobile navigation.
  const toggle = document.querySelector('.site-nav-toggle');
  const nav = document.querySelector('.site-nav');

  if (toggle && nav) {
    const toggleLabel = toggle.querySelector('.screen-reader-text');
    const mobileBreakpoint = window.matchMedia('(max-width: 820px)');

    const setExpanded = (expanded) => {
      toggle.setAttribute('aria-expanded', String(expanded));
      nav.classList.toggle('is-open', expanded);
      if (toggleLabel) {
        toggleLabel.textContent = expanded ? 'بستن منو' : 'باز کردن منو';
      }
    };

    toggle.addEventListener('click', () => {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      setExpanded(!expanded);
    });

    nav.addEventListener('click', (event) => {
      const link = event.target.closest('a');
      if (link && mobileBreakpoint.matches) setExpanded(false);
    });

    document.addEventListener('click', (event) => {
      if (!nav.classList.contains('is-open')) return;
      if (nav.contains(event.target) || toggle.contains(event.target)) return;
      setExpanded(false);
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && nav.classList.contains('is-open')) {
        setExpanded(false);
        toggle.focus();
      }
    });

    window.addEventListener('resize', () => {
      if (!mobileBreakpoint.matches) setExpanded(false);
    });
  }

  // The homepage pathfinder is local-only: it never submits or stores user data.
  const pathfinder = document.querySelector('.pathfinder-widget');
  if (pathfinder) {
    const tabs = Array.from(pathfinder.querySelectorAll('[data-path-choice]'));
    const panels = Array.from(pathfinder.querySelectorAll('[data-path-panel]'));

    const activateTab = (tab, moveFocus) => {
      const target = tab.getAttribute('data-path-choice');
      tabs.forEach((item) => {
        const active = item === tab;
        item.classList.toggle('is-active', active);
        item.setAttribute('aria-selected', String(active));
        item.tabIndex = active ? 0 : -1;
      });
      panels.forEach((panel) => {
        panel.hidden = panel.getAttribute('data-path-panel') !== target;
      });
      if (moveFocus) tab.focus();
    };

    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => activateTab(tab, false));
      tab.addEventListener('keydown', (event) => {
        const rtl = document.documentElement.dir === 'rtl';
        let nextIndex = index;
        if (event.key === 'Home') nextIndex = 0;
        else if (event.key === 'End') nextIndex = tabs.length - 1;
        else if (event.key === (rtl ? 'ArrowLeft' : 'ArrowRight')) nextIndex = (index + 1) % tabs.length;
        else if (event.key === (rtl ? 'ArrowRight' : 'ArrowLeft')) nextIndex = (index - 1 + tabs.length) % tabs.length;
        else return;
        event.preventDefault();
        activateTab(tabs[nextIndex], true);
      });
    });
  }

  // Progressive reveal: content remains visible if motion is reduced or the API is unavailable.
  const revealItems = Array.from(document.querySelectorAll('[data-reveal]'));
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (revealItems.length && !reduceMotion && 'IntersectionObserver' in window) {
    document.documentElement.classList.add('has-retinno-motion');
    const observer = new IntersectionObserver((entries, instance) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.setAttribute('data-revealed', 'true');
        instance.unobserve(entry.target);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -32px 0px' });

    revealItems.forEach((item) => observer.observe(item));
  }
})();
