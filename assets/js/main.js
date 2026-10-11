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

  // Scroll progress bar + sticky header elevation + back-to-top visibility.
  const progressBar = document.querySelector('.scroll-progress__bar');
  const progressWrap = document.querySelector('.scroll-progress');
  const header = document.querySelector('.site-header');
  const backToTop = document.querySelector('.back-to-top');
  if (progressBar || header || backToTop) {
    let ticking = false;
    const onScrollFrame = () => {
      ticking = false;
      const doc = document.documentElement;
      const scrollable = doc.scrollHeight - doc.clientHeight;
      const y = window.scrollY || doc.scrollTop || 0;
      const ratio = scrollable > 0 ? Math.min(1, Math.max(0, y / scrollable)) : 0;
      if (progressBar) {
        progressBar.style.setProperty('--rt-scroll', ratio.toFixed(4));
        if (progressWrap) progressWrap.classList.toggle('is-active', ratio > 0.015);
      }
      if (header) header.classList.toggle('is-scrolled', y > 10);
      if (backToTop) backToTop.classList.toggle('is-visible', y > 620);
    };
    const requestScrollSync = () => {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(onScrollFrame);
    };
    window.addEventListener('scroll', requestScrollSync, { passive: true });
    window.addEventListener('resize', requestScrollSync, { passive: true });
    onScrollFrame();

    if (backToTop) {
      backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
      });
    }
  }

  // Sliding underline that follows the hovered navigation item (RTL aware).
  if (nav && !reduceMotion) {
    const links = Array.from(nav.querySelectorAll('.menu-item > a, .site-nav__item > a'));
    if (links.length) {
      const marker = document.createElement('span');
      marker.className = 'nav-hover-marker';
      marker.setAttribute('aria-hidden', 'true');
      nav.appendChild(marker);
      const activeLink = nav.querySelector('.is-current > a, .current-menu-item > a, .current_page_item > a');
      const setActive = (link) => {
        links.forEach((item) => item.parentElement.classList.remove('is-current'));
        if (link && link.parentElement) link.parentElement.classList.add('is-current');
      };
      const showAt = (link) => {
        if (!link || nav.classList.contains('is-open')) { hideMarker(); return; }
        marker.hidden = false;
        marker.style.width = `${link.offsetWidth}px`;
        marker.style.right = `${link.offsetLeft}px`;
        marker.style.left = 'auto';
      };
      const hideMarker = () => {
        const current = nav.querySelector('.is-current > a');
        if (current) showAt(current); else marker.hidden = true;
      };
      links.forEach((link) => {
        link.addEventListener('mouseenter', () => showAt(link));
        link.addEventListener('focus', () => showAt(link));
      });
      nav.addEventListener('mouseleave', () => {
        hideMarker();
        setActive(activeLink);
      });
      if (activeLink) showAt(activeLink); else marker.hidden = true;
      window.addEventListener('resize', () => {
        const current = nav.querySelector('.is-current > a') || (marker.hidden ? null : activeLink);
        if (current) showAt(current);
      });
    }
  }

  // Cursor spotlight on interactive cards (pointer devices only).
  if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    document.querySelectorAll('.feature-card, .consultant-card, .article-card').forEach((card) => {
      card.addEventListener('pointermove', (event) => {
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--rt-spot-x', `${event.clientX - rect.left}px`);
        card.style.setProperty('--rt-spot-y', `${event.clientY - rect.top}px`);
      });
    });
  }

  // Animated counters: Persian digits, runs once when visible, static if motion is reduced.
  const counters = Array.from(document.querySelectorAll('[data-count-to]'));
  if (counters.length && 'IntersectionObserver' in window) {
    const toPersian = (value) => String(value).replace(/\d/g, (d) => '۰۱۲۳۴۵۶۷۸۹'[Number(d)]);
    const startCounter = (el) => {
      const target = parseInt(el.getAttribute('data-count-to'), 10);
      if (!Number.isFinite(target)) return;
      if (reduceMotion) { el.textContent = toPersian(target); return; }
      const duration = 1400;
      const startedAt = performance.now();
      const step = (now) => {
        const progress = Math.min(1, (now - startedAt) / duration);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = toPersian(Math.round(target * eased));
        if (progress < 1) window.requestAnimationFrame(step);
      };
      window.requestAnimationFrame(step);
    };
    const counterObserver = new IntersectionObserver((entries, instance) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        startCounter(entry.target);
        instance.unobserve(entry.target);
      });
    }, { threshold: 0.5 });
    counters.forEach((counter) => counterObserver.observe(counter));
  }
})();
