(function () {
  'use strict';

  const API_URL  = '/api/search';
  const DEBOUNCE = 280;
  const MIN_CHARS = 2;

  // ── DOM refs ──────────────────────────────────────────────────
  const wrap       = document.getElementById('searchWrap');
  const input      = document.getElementById('searchInput');
  const button     = document.getElementById('searchButton');
  const dropdown   = document.getElementById('searchDropdown');
  const loading    = document.getElementById('sbLoading');
  const empty      = document.getElementById('sbEmpty');
  const results    = document.getElementById('sbResults');
  const footer     = document.getElementById('sbFooter');
  const seeAllLink = document.getElementById('sbSeeAll');
  const seeAllText = document.getElementById('sbSeeAllText');

  // ✅ Guard: batalkan jika elemen utama tidak ditemukan
  if (!wrap || !input || !dropdown) return;

  // ── State ──────────────────────────────────────────────────────
  let debounceTimer   = null;
  let currentQuery    = '';
  let activeIndex     = -1;
  let abortController = null;

  // ── Helpers ────────────────────────────────────────────────────
  function show(el) { if (el) el.removeAttribute('hidden'); }
  function hide(el) { if (el) el.setAttribute('hidden', ''); }

  function showDropdown() {
    wrap.classList.add('sb-active');
    dropdown.removeAttribute('hidden');
    input.setAttribute('aria-expanded', 'true');
  }

  function hideDropdown() {
    wrap.classList.remove('sb-active');
    dropdown.setAttribute('hidden', '');
    input.setAttribute('aria-expanded', 'false');
    activeIndex = -1;
    clearActive();
  }

  function clearActive() {
    dropdown.querySelectorAll('.sb-item').forEach(el => el.classList.remove('sb-item--active'));
  }

  // ── Highlight ──────────────────────────────────────────────────
  function highlight(text, query) {
    if (!query) return escapeHtml(text);
    const escaped = escapeHtml(text);
    const re = new RegExp(`(${escapeRegex(query)})`, 'gi');
    return escaped.replace(re, '<mark>$1</mark>');
  }

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function escapeRegex(str) {
    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
  }

  // ── Render ─────────────────────────────────────────────────────
  function renderResults(data) {
    if (!results) return;
    results.innerHTML = '';
    const items = data.results || [];

    if (items.length === 0) {
      hide(loading);
      show(empty);
      hide(footer);
      hide(results);
      return;
    }

    hide(loading);
    hide(empty);
    show(results);

    const klinik = items.filter(i => i.type === 'klinik');
    const mitra  = items.filter(i => i.type === 'mitra');

    if (klinik.length > 0) {
      appendGroupLabel('Klinik & Fasilitas TBC');
      klinik.forEach(item => results.appendChild(buildItem(item, data.query)));
    }

    if (mitra.length > 0) {
      if (klinik.length > 0) {
        const hr = document.createElement('hr');
        hr.className = 'sb-divider';
        results.appendChild(hr);
      }
      appendGroupLabel('Mitra Program');
      mitra.forEach(item => results.appendChild(buildItem(item, data.query)));
    }

    if (data.total > items.length && seeAllLink && seeAllText) {
      seeAllLink.href = `/cari?q=${encodeURIComponent(data.query)}`;
      seeAllText.textContent = `Lihat semua ${data.total} hasil untuk "${data.query}"`;
      show(footer);
    } else {
      hide(footer);
    }
  }

  function appendGroupLabel(label) {
    const li = document.createElement('li');
    li.className = 'sb-group-label';
    li.textContent = label;
    results.appendChild(li);
  }

  function buildItem(item, query) {
    const li = document.createElement('li');
    const isKlinik = item.type === 'klinik';

    const iconClass = isKlinik ? 'sb-item-icon--klinik' : 'sb-item-icon--mitra';
    const iconBI    = isKlinik ? 'bi-hospital-fill' : 'bi-people-fill';
    const typeClass = isKlinik ? 'sb-item-type--klinik' : 'sb-item-type--mitra';

    let statusHtml = '';
    if (isKlinik && item.status) {
      const sc = item.status_open ? 'sb-item-status--open' : 'sb-item-status--closed';
      statusHtml = `<span class="sb-item-status ${sc}">${escapeHtml(item.status)}</span>`;
    }

    let servicesHtml = '';
    if (isKlinik && item.layanan && item.layanan.length > 0) {
      servicesHtml = `<div class="sb-item-services">
        ${item.layanan.map(s => `<span class="sb-svc">${escapeHtml(s)}</span>`).join('')}
      </div>`;
    }

    li.innerHTML = `
      <a href="${escapeHtml(item.url)}" class="sb-item" role="option">
        <div class="sb-item-icon ${iconClass}">
          <i class="bi ${iconBI}"></i>
        </div>
        <div class="sb-item-body">
          <div class="sb-item-name">${highlight(item.nama, query)}</div>
          <div class="sb-item-meta">
            <span class="sb-item-type ${typeClass}">${escapeHtml(item.type_label)}</span>
            <span class="sb-item-loc">${escapeHtml(item.kota)}</span>
            ${statusHtml}
          </div>
          ${servicesHtml}
        </div>
        <i class="bi bi-arrow-right sb-item-arrow"></i>
      </a>`;

    return li;
  }

  // ── Fetch ──────────────────────────────────────────────────────
  async function fetchSearch(query) {
    if (abortController) abortController.abort();
    abortController = new AbortController();

    showDropdown();
    show(loading);
    hide(empty);
    hide(footer);
    if (results) results.innerHTML = '';

    try {
      const url  = `${API_URL}?q=${encodeURIComponent(query)}`;
      const resp = await fetch(url, {
        signal: abortController.signal,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }, // ✅ biar Laravel tahu ini AJAX
      });
      if (!resp.ok) throw new Error('Network error');
      const data = await resp.json();
      hide(loading);
      renderResults(data);
    } catch (err) {
      if (err.name === 'AbortError') return;
      hide(loading);
      show(empty);
    }
  }

  // ── Keyboard navigation ────────────────────────────────────────
  function getItems() {
    return [...dropdown.querySelectorAll('.sb-item')];
  }

  function setActive(index) {
    const items = getItems();
    clearActive();
    activeIndex = index;
    if (index >= 0 && index < items.length) {
      items[index].classList.add('sb-item--active');
      items[index].scrollIntoView({ block: 'nearest' });
    }
  }

  input.addEventListener('keydown', (e) => {
    const items = getItems();
    switch (e.key) {
      case 'ArrowDown':
        e.preventDefault();
        if (!dropdown.hasAttribute('hidden')) {
          setActive(Math.min(activeIndex + 1, items.length - 1));
        }
        break;
      case 'ArrowUp':
        e.preventDefault();
        setActive(Math.max(activeIndex - 1, -1));
        if (activeIndex === -1) input.focus();
        break;
      case 'Enter':
        e.preventDefault();
        if (activeIndex >= 0 && items[activeIndex]) {
          items[activeIndex].click();
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

  // ── Input handler ──────────────────────────────────────────────
  input.addEventListener('input', () => {
    const q = input.value.trim();
    currentQuery = q;
    activeIndex  = -1;
    clearTimeout(debounceTimer);

    if (q.length < MIN_CHARS) {
      hideDropdown();
      return;
    }

    debounceTimer = setTimeout(() => {
      if (input.value.trim() === q) fetchSearch(q);
    }, DEBOUNCE);
  });

  // ── Search button ──────────────────────────────────────────────
  // ✅ Guard null untuk button
  if (button) {
    button.addEventListener('click', () => {
      const q = input.value.trim();
      if (q.length >= MIN_CHARS) {
        window.location.href = `/cari?q=${encodeURIComponent(q)}`;
      } else {
        input.focus();
      }
    });
  }

  // ── Focus ──────────────────────────────────────────────────────
  input.addEventListener('focus', () => {
    if (input.value.trim().length >= MIN_CHARS && results && results.children.length > 0) {
      showDropdown();
    }
  });

  // ── Click outside ──────────────────────────────────────────────
  document.addEventListener('click', (e) => {
    if (!wrap.contains(e.target)) hideDropdown();
  });

  // ── Touch scroll ───────────────────────────────────────────────
  document.addEventListener('touchmove', hideDropdown, { passive: true });

})();