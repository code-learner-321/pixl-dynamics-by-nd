function syncMenuArrows() {
  const isDesktop = window.innerWidth >= 992;

  document.querySelectorAll('.menu-arrow').forEach(arrow => {
    const depth = parseInt(arrow.dataset.depth || '0');
    const desktopSetting = arrow.dataset.desktop;

    // Top-level down arrow
    if (depth === 0) {
      arrow.style.display = isDesktop
        ? (desktopSetting === 'yes' ? 'inline-block' : 'none')
        : 'inline-block'; // always visible on mobile
    }

    // Sub-level right arrow (desktop only)
    if (depth === 1 && arrow.classList.contains('sub-arrow')) {
      arrow.style.display = isDesktop && desktopSetting === 'yes' ? 'inline-block' : 'none';
    }

    // Sub-level down arrow (mobile/tablet only)
    if (depth === 1 && arrow.classList.contains('sub-arrow-mobile')) {
      arrow.style.display = isDesktop ? 'none' : 'inline-block';
    }
  });
}

window.addEventListener('load', syncMenuArrows);
window.addEventListener('resize', syncMenuArrows);

const observer = new MutationObserver(syncMenuArrows);
observer.observe(document.body, { childList: true, subtree: true });