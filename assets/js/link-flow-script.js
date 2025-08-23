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

// Enhanced submenu arrow toggling functionality
function initSubmenuArrows() {
  console.log('Initializing submenu arrows...');
  
  // Handle submenu toggle clicks
  document.querySelectorAll('.submenu-toggle').forEach(toggle => {
    toggle.addEventListener('change', function() {
      const arrow = this.nextElementSibling?.querySelector('.submenu-arrow');
      console.log('Submenu toggled:', this.checked ? 'open' : 'closed', 'Arrow found:', !!arrow);
      
      if (arrow) {
        // Force the arrow rotation
        if (this.checked) {
          arrow.style.transform = 'rotate(180deg)';
        } else {
          arrow.style.transform = 'rotate(0deg)';
        }
      }
    });
  });

  // Ensure all submenu arrows are properly initialized
  document.querySelectorAll('.submenu-arrow').forEach(arrow => {
    // Reset arrow rotation on page load
    arrow.style.transform = 'rotate(0deg)';
    console.log('Arrow initialized:', arrow);
  });
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOM ready - initializing menu functionality');
  syncMenuArrows();
  initSubmenuArrows();
});

window.addEventListener('load', function() {
  console.log('Window loaded - syncing menu arrows');
  syncMenuArrows();
  initSubmenuArrows();
});

window.addEventListener('resize', syncMenuArrows);

const observer = new MutationObserver(function(mutations) {
  console.log('DOM changed - re-initializing menu functionality');
  syncMenuArrows();
  initSubmenuArrows(); // Re-initialize when DOM changes
});
observer.observe(document.body, { childList: true, subtree: true });

// script for double line hover animation...
  // document.addEventListener("DOMContentLoaded", function () {
  //   const menuItems = document.querySelectorAll("nav.menu>ul > li");

  //   menuItems.forEach(item => {
  //     const hasSubmenu = item.querySelector("nav.menu>ul");
  //     const link = item.querySelector("nav.menu>ul li a");

  //     if (link && !hasSubmenu) {
  //       link.classList.add("hover-effect");
  //     }
  //   });
  // });