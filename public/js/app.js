document.addEventListener('DOMContentLoaded', () => {
  const navbar = document.getElementById('mainNavbar');
  const collapse = document.getElementById('mainNavbarCollapse');
  const toggler = document.getElementById('navbarToggler');

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
    const menu = item.querySelector('.dropdown-menu');
    if (!trigger || !menu) return;

    item.addEventListener('mouseenter', () => menu.classList.add('show'));
    item.addEventListener('mouseleave', () => menu.classList.remove('show'));
    trigger.addEventListener('click', (event) => {
      event.preventDefault();
      document.querySelectorAll('.nav-dropdown .dropdown-menu.show').forEach((open) => {
        if (open !== menu) open.classList.remove('show');
      });
      menu.classList.toggle('show');
    });
  });

  const searchInput = document.getElementById('searchInput');
  const searchButton = document.getElementById('searchButton');
  const doSearch = () => {
    const query = searchInput?.value.trim();
    if (query) alert(`Mencari: ${query}`);
  };
  searchButton?.addEventListener('click', doSearch);
  searchInput?.addEventListener('keyup', (event) => {
    if (event.key === 'Enter') doSearch();
  });
  searchInput?.addEventListener('focus', () => searchInput.closest('.search-box')?.classList.add('focused'));
  searchInput?.addEventListener('blur', () => searchInput.closest('.search-box')?.classList.remove('focused'));

  const langButton = document.getElementById('langButton');
  const langDropdown = document.getElementById('langDropdown');
  const activeFlag = document.getElementById('activeFlag');
  const setLang = (code) => {
    localStorage.setItem('preferred-lang', code);
    if (activeFlag) {
      activeFlag.src = code === 'id' ? 'https://flagcdn.com/w40/id.png' : 'https://flagcdn.com/w40/gb.png';
      activeFlag.alt = code;
    }
    document.querySelectorAll('.lang-option').forEach((option) => {
      option.classList.toggle('active', option.dataset.lang === code);
    });
  };
  setLang(localStorage.getItem('preferred-lang') || 'id');
  langButton?.addEventListener('click', (event) => {
    event.stopPropagation();
    langDropdown?.classList.toggle('show');
  });
  document.querySelectorAll('.lang-option').forEach((option) => {
    option.addEventListener('click', () => {
      setLang(option.dataset.lang || 'id');
      langDropdown?.classList.remove('show');
    });
  });

  document.addEventListener('click', (event) => {
    if (!event.target.closest('.navbar')) {
      document.querySelectorAll('.navbar .dropdown-menu.show').forEach((menu) => menu.classList.remove('show'));
    }
  });

  document.querySelectorAll('[data-photo-gallery]').forEach((gallery) => {
    const items = gallery.querySelectorAll('[data-photo-item]');
    items.forEach((item) => {
      item.addEventListener('click', () => {
        const selected = item.dataset.photoItem;
        const alreadyExpanded = item.classList.contains('expanded');
        items.forEach((other) => other.classList.remove('expanded', 'shrunk'));
        if (!alreadyExpanded) {
          items.forEach((other) => {
            other.classList.toggle('expanded', other.dataset.photoItem === selected);
            other.classList.toggle('shrunk', other.dataset.photoItem !== selected);
          });
        }
      });
    });
  });

  const playButton = document.getElementById('videoPlayButton');
  playButton?.addEventListener('click', () => {
    playButton.classList.toggle('bi-play-fill');
    playButton.classList.toggle('bi-pause-fill');
  });

  document.querySelectorAll('[data-tujuan-cards]').forEach((wrapper) => {
    const cards = wrapper.querySelectorAll('[data-tujuan-card]');
    cards.forEach((card) => {
      card.addEventListener('click', () => {
        cards.forEach((item) => item.classList.remove('active'));
        card.classList.add('active');
      });
    });
  });

  const timelineContent = document.getElementById('timelineContent');

if (timelineContent) {
  const timeline = JSON.parse(timelineContent.dataset.timeline || '[]');

  let activeIndex = Math.min(1, Math.max(0, timeline.length - 1));

  const image = document.getElementById('timelineImage');
  const year = document.getElementById('timelineYear');
  const title = document.getElementById('timelineTitle');
  const desc = document.getElementById('timelineDesc');
  const fill = document.getElementById('timelineFill');
  const prev = document.getElementById('timelinePrev');
  const next = document.getElementById('timelineNext');
  const points = document.querySelectorAll('.sj-point');

  const baseAssetUrl = timelineContent.dataset.assetUrl || '/';

  const renderTimeline = () => {
    const current = timeline[activeIndex];

    if (!current) return;

    if (image) {
      image.src = baseAssetUrl + current.image;
      image.alt = current.title;
    }

    if (year) year.textContent = current.year;
    if (title) title.textContent = current.title;
    if (desc) desc.textContent = current.desc;

    if (fill) {
      fill.style.width = timeline.length > 1
        ? `${(activeIndex / (timeline.length - 1)) * 100}%`
        : '0%';
    }

    points.forEach((point, index) => {
      const dot = point.querySelector('.sj-dot');
      const label = point.querySelector('.sj-year-label');

      point.classList.toggle('active', index === activeIndex);

      dot?.classList.toggle('active', index === activeIndex);
      dot?.classList.toggle('passed', index < activeIndex);

      label?.classList.toggle('active', index <= activeIndex);
    });

    if (prev) prev.disabled = activeIndex === 0;
    if (next) next.disabled = activeIndex === timeline.length - 1;
  };

  points.forEach((point) => {
    point.addEventListener('click', () => {
      activeIndex = Number(point.dataset.index || 0);
      renderTimeline();
    });
  });

  prev?.addEventListener('click', () => {
    if (activeIndex > 0) {
      activeIndex -= 1;
      renderTimeline();
    }
  });

  next?.addEventListener('click', () => {
    if (activeIndex < timeline.length - 1) {
      activeIndex += 1;
      renderTimeline();
    }
  });

  renderTimeline();
}

  const newsletterForm = document.getElementById('newsletterForm');
  newsletterForm?.addEventListener('submit', (event) => {
    event.preventDefault();
    const input = newsletterForm.querySelector('input[name="email"]');
    if (input?.value) {
      alert(`Terima kasih! ${input.value} telah didaftarkan.`);
      input.value = '';
    }
  });
});
