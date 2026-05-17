document.addEventListener('DOMContentLoaded', () => {

  /* ============================================================
     NAVBAR — scroll, toggler, dropdowns
  ============================================================ */
  const navbar   = document.getElementById('mainNavbar');
  const collapse = document.getElementById('mainNavbarCollapse');
  const toggler  = document.getElementById('navbarToggler');

  const handleScroll = () => {
    if (!navbar) return;
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  };
  handleScroll();
  window.addEventListener('scroll', handleScroll);

  if (toggler && collapse) {
    toggler.addEventListener('click', () => {
      collapse.classList.toggle('show');
      collapse.classList.toggle('collapse', !collapse.classList.contains('show'));
    });
  }

  document.querySelectorAll('.nav-dropdown').forEach((item) => {
    const trigger = item.querySelector('.dropdown-toggle-custom');
    const menu    = item.querySelector('.dropdown-menu');
    if (!trigger || !menu) return;

    item.addEventListener('mouseenter', () => menu.classList.add('show'));
    item.addEventListener('mouseleave', () => menu.classList.remove('show'));
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      document.querySelectorAll('.nav-dropdown .dropdown-menu.show').forEach((open) => {
        if (open !== menu) open.classList.remove('show');
      });
      menu.classList.toggle('show');
    });
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.navbar')) {
      document.querySelectorAll('.navbar .dropdown-menu.show').forEach((m) => m.classList.remove('show'));
    }
  });

  /* ============================================================
     SEARCH BOX — live dropdown
  ============================================================ */
  const API_URL   = '/api/search';
  const DEBOUNCE  = 280;
  const MIN_CHARS = 2;

  const wrap        = document.getElementById('searchWrap');
  const input       = document.getElementById('searchInput');
  const btn         = document.getElementById('searchButton');
  const dropdown    = document.getElementById('searchDropdown');
  const loading     = document.getElementById('sbLoading');
  const empty       = document.getElementById('sbEmpty');
  const resultsList = document.getElementById('sbResults');
  const footer      = document.getElementById('sbFooter');
  const seeAllLink  = document.getElementById('sbSeeAll');
  const seeAllText  = document.getElementById('sbSeeAllText');

  if (wrap && input && dropdown) {

    let debounceTimer = null;
    let activeIdx     = -1;
    let abortCtrl     = null;

    const show = (el) => { if (el) el.removeAttribute('hidden'); };
    const hide = (el) => { if (el) el.setAttribute('hidden', ''); };

    const showDropdown = () => {
      wrap.classList.add('sb-active');
      dropdown.removeAttribute('hidden');
      input.setAttribute('aria-expanded', 'true');
    };

    const hideDropdown = () => {
      wrap.classList.remove('sb-active');
      dropdown.setAttribute('hidden', '');
      input.setAttribute('aria-expanded', 'false');
      activeIdx = -1;
      clearActive();
    };

    const clearActive = () => {
      dropdown.querySelectorAll('.sb-item').forEach((el) => el.classList.remove('sb-item--active'));
    };

    const escHtml = (s) => String(s)
      .replace(/&/g,'&amp;').replace(/</g,'&lt;')
      .replace(/>/g,'&gt;').replace(/"/g,'&quot;');

    const escReg = (s) => s.replace(/[.*+?^${}()|[\]\\]/g,'\\$&');

    const highlight = (text, q) => {
      if (!q) return escHtml(text);
      return escHtml(text).replace(new RegExp(`(${escReg(q)})`,'gi'),'<mark>$1</mark>');
    };

    const buildItem = (item, q) => {
      const li       = document.createElement('li');
      const isKlinik = item.type === 'klinik';

      let statusHtml = '';
      if (isKlinik && item.status) {
        const sc = item.status_open ? 'sb-item-status--open' : 'sb-item-status--closed';
        statusHtml = `<span class="sb-item-status ${sc}">${escHtml(item.status)}</span>`;
      }

      let servHtml = '';
      if (isKlinik && item.layanan?.length) {
        servHtml = `<div class="sb-item-services">
          ${item.layanan.map((s) => `<span class="sb-svc">${escHtml(s)}</span>`).join('')}
        </div>`;
      }

      li.innerHTML = `
        <a href="${escHtml(item.url)}" class="sb-item" role="option">
          <div class="sb-item-icon ${isKlinik ? 'sb-item-icon--klinik' : 'sb-item-icon--mitra'}">
            <i class="bi ${isKlinik ? 'bi-hospital-fill' : 'bi-people-fill'}"></i>
          </div>
          <div class="sb-item-body">
            <div class="sb-item-name">${highlight(item.nama, q)}</div>
            <div class="sb-item-meta">
              <span class="sb-item-type ${isKlinik ? 'sb-item-type--klinik' : 'sb-item-type--mitra'}">${escHtml(item.type_label)}</span>
              <span class="sb-item-loc">${escHtml(item.kota)}</span>
              ${statusHtml}
            </div>
            ${servHtml}
          </div>
          <i class="bi bi-arrow-right sb-item-arrow"></i>
        </a>`;
      return li;
    };

    const renderResults = (data) => {
      if (!resultsList) return;
      resultsList.innerHTML = '';
      const items = data.results || [];

      if (!items.length) {
        hide(loading); show(empty); hide(footer); hide(resultsList);
        return;
      }

      hide(loading); hide(empty); show(resultsList);

      const klinik = items.filter((i) => i.type === 'klinik');
      const mitra  = items.filter((i) => i.type === 'mitra');

      if (klinik.length) {
        const lbl = document.createElement('li');
        lbl.className   = 'sb-group-label';
        lbl.textContent = 'Klinik & Fasilitas TBC';
        resultsList.appendChild(lbl);
        klinik.forEach((item) => resultsList.appendChild(buildItem(item, data.query)));
      }

      if (mitra.length) {
        if (klinik.length) {
          const hr = document.createElement('hr');
          hr.className = 'sb-divider';
          resultsList.appendChild(hr);
        }
        const lbl = document.createElement('li');
        lbl.className   = 'sb-group-label';
        lbl.textContent = 'Mitra Program';
        resultsList.appendChild(lbl);
        mitra.forEach((item) => resultsList.appendChild(buildItem(item, data.query)));
      }

      if (data.total > items.length && seeAllLink && seeAllText) {
        seeAllLink.href        = `/cari?q=${encodeURIComponent(data.query)}`;
        seeAllText.textContent = `Lihat semua ${data.total} hasil untuk "${data.query}"`;
        show(footer);
      } else {
        hide(footer);
      }
    };

    const fetchSearch = async (query) => {
      if (abortCtrl) abortCtrl.abort();
      abortCtrl = new AbortController();

      showDropdown();
      show(loading); hide(empty); hide(footer);
      if (resultsList) resultsList.innerHTML = '';

      try {
        const res = await fetch(`${API_URL}?q=${encodeURIComponent(query)}`, {
          signal : abortCtrl.signal,
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        if (!res.ok) throw new Error('Network error');
        const data = await res.json();
        hide(loading);
        renderResults(data);
      } catch (err) {
        if (err.name === 'AbortError') return;
        hide(loading); show(empty);
      }
    };

    const getItems = () => [...dropdown.querySelectorAll('.sb-item')];

    const setActive = (idx) => {
      const items = getItems();
      clearActive();
      activeIdx = idx;
      if (idx >= 0 && idx < items.length) {
        items[idx].classList.add('sb-item--active');
        items[idx].scrollIntoView({ block: 'nearest' });
      }
    };

    input.addEventListener('keydown', (e) => {
      const items = getItems();
      switch (e.key) {
        case 'ArrowDown':
          e.preventDefault();
          if (!dropdown.hasAttribute('hidden')) setActive(Math.min(activeIdx + 1, items.length - 1));
          break;
        case 'ArrowUp':
          e.preventDefault();
          setActive(Math.max(activeIdx - 1, -1));
          break;
        case 'Enter':
          e.preventDefault();
          if (activeIdx >= 0 && items[activeIdx]) {
            items[activeIdx].click();
          } else {
            const q = input.value.trim();
            if (q.length >= MIN_CHARS) window.location.href = `/cari?q=${encodeURIComponent(q)}`;
          }
          break;
        case 'Escape':
          hideDropdown();
          input.blur();
          break;
      }
    });

    input.addEventListener('input', () => {
      const q = input.value.trim();
      activeIdx = -1;
      clearTimeout(debounceTimer);
      if (q.length < MIN_CHARS) { hideDropdown(); return; }
      debounceTimer = setTimeout(() => {
        if (input.value.trim() === q) fetchSearch(q);
      }, DEBOUNCE);
    });

    btn?.addEventListener('click', () => {
      const q = input.value.trim();
      if (q.length >= MIN_CHARS) window.location.href = `/cari?q=${encodeURIComponent(q)}`;
      else input.focus();
    });

    input.addEventListener('focus', () => {
      input.closest('.search-box')?.classList.add('focused');
      if (input.value.trim().length >= MIN_CHARS && resultsList?.children.length) showDropdown();
    });

    input.addEventListener('blur', () => {
      input.closest('.search-box')?.classList.remove('focused');
    });

    document.addEventListener('click', (e) => {
      if (!wrap.contains(e.target)) hideDropdown();
    });

    document.addEventListener('touchmove', hideDropdown, { passive: true });
  }

  /* ============================================================
     LANGUAGE SWITCHER
  ============================================================ */
  const langButton   = document.getElementById('langButton');
  const langDropdown = document.getElementById('langDropdown');
  const activeFlag   = document.getElementById('activeFlag');

  const setLang = (code) => {
    localStorage.setItem('preferred-lang', code);
    if (activeFlag) {
      activeFlag.src = code === 'id' ? 'https://flagcdn.com/w40/id.png' : 'https://flagcdn.com/w40/gb.png';
      activeFlag.alt = code;
    }
    document.querySelectorAll('.lang-option').forEach((o) => {
      o.classList.toggle('active', o.dataset.lang === code);
    });
  };
  setLang(localStorage.getItem('preferred-lang') || 'id');

  langButton?.addEventListener('click', (e) => {
    e.stopPropagation();
    langDropdown?.classList.toggle('show');
  });

  document.querySelectorAll('.lang-option').forEach((o) => {
    o.addEventListener('click', () => {
      setLang(o.dataset.lang || 'id');
      langDropdown?.classList.remove('show');
    });
  });

  /* ============================================================
     PHOTO GALLERY
  ============================================================ */
  document.querySelectorAll('[data-photo-gallery]').forEach((gallery) => {
    const items = gallery.querySelectorAll('[data-photo-item]');
    items.forEach((item) => {
      item.addEventListener('click', () => {
        const sel      = item.dataset.photoItem;
        const expanded = item.classList.contains('expanded');
        items.forEach((o) => o.classList.remove('expanded','shrunk'));
        if (!expanded) {
          items.forEach((o) => {
            o.classList.toggle('expanded', o.dataset.photoItem === sel);
            o.classList.toggle('shrunk',   o.dataset.photoItem !== sel);
          });
        }
      });
    });
  });

  /* ============================================================
     VIDEO PLAY BUTTON
  ============================================================ */
  document.getElementById('videoPlayButton')?.addEventListener('click', function () {
    this.classList.toggle('bi-play-fill');
    this.classList.toggle('bi-pause-fill');
  });

  /* ============================================================
     TUJUAN CARDS
  ============================================================ */
  document.querySelectorAll('[data-tujuan-cards]').forEach((wrapper) => {
    const cards = wrapper.querySelectorAll('[data-tujuan-card]');
    cards.forEach((card) => {
      card.addEventListener('click', () => {
        cards.forEach((c) => c.classList.remove('active'));
        card.classList.add('active');
      });
    });
  });

  /* ============================================================
     TIMELINE
  ============================================================ */
  const timelineContent = document.getElementById('timelineContent');
  if (timelineContent) {
    const timeline  = JSON.parse(timelineContent.dataset.timeline || '[]');
    let activeIndex = Math.min(1, Math.max(0, timeline.length - 1));

    const image  = document.getElementById('timelineImage');
    const year   = document.getElementById('timelineYear');
    const title  = document.getElementById('timelineTitle');
    const desc   = document.getElementById('timelineDesc');
    const fill   = document.getElementById('timelineFill');
    const prev   = document.getElementById('timelinePrev');
    const next   = document.getElementById('timelineNext');
    const points = document.querySelectorAll('.sj-point');
    const baseUrl = timelineContent.dataset.assetUrl || '/';

    const renderTimeline = () => {
      const cur = timeline[activeIndex];
      if (!cur) return;
      if (image) { image.src = baseUrl + cur.image; image.alt = cur.title; }
      if (year)  year.textContent  = cur.year;
      if (title) title.textContent = cur.title;
      if (desc)  desc.textContent  = cur.desc;
      if (fill)  fill.style.width  = timeline.length > 1
        ? `${(activeIndex / (timeline.length - 1)) * 100}%` : '0%';

      points.forEach((pt, i) => {
        const dot   = pt.querySelector('.sj-dot');
        const label = pt.querySelector('.sj-year-label');
        pt.classList.toggle('active', i === activeIndex);
        dot?.classList.toggle('active', i === activeIndex);
        dot?.classList.toggle('passed', i < activeIndex);
        label?.classList.toggle('active', i <= activeIndex);
      });

      if (prev) prev.disabled = activeIndex === 0;
      if (next) next.disabled = activeIndex === timeline.length - 1;
    };

    points.forEach((pt) => {
      pt.addEventListener('click', () => {
        activeIndex = Number(pt.dataset.index || 0);
        renderTimeline();
      });
    });

    prev?.addEventListener('click', () => {
      if (activeIndex > 0) { activeIndex--; renderTimeline(); }
    });
    next?.addEventListener('click', () => {
      if (activeIndex < timeline.length - 1) { activeIndex++; renderTimeline(); }
    });

    renderTimeline();
  }

  /* ============================================================
     NEWSLETTER FORM
  ============================================================ */
  document.getElementById('newsletterForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const inp = e.target.querySelector('input[name="email"]');
    if (inp?.value) {
      alert(`Terima kasih! ${inp.value} telah didaftarkan.`);
      inp.value = '';
    }
  });

});